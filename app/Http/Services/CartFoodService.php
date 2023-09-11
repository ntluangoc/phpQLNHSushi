<?php

namespace App\Http\Services;
use App\Models\BookingFood;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\Food;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartFoodService
{
    public function getNumCart($user)
    {
        $cart = Cart::where('idUser', $user->idUser)->first();
        if (!$cart) {
            $cart = Cart::create([
                'idUser' => $user->idUser,
            ]);
        }
        $numCartFood = CartFood::where('idCart', $cart->idCart)
                                ->where('isPay',0)
                                ->count();
        return $numCartFood;
    }
    public function getTop5Cart($user)
    {
        $cart = Cart::where('idUser', $user->idUser)->first();
        if (!$cart) {
            $cart = Cart::create([
                'idUser' => $user->idUser,
            ]);
        }
        $listCartFood = CartFood::join('food', 'cartfood.idFood', '=', 'food.idFood')
                                ->where('cartfood.idCart', $cart->idCart)
                                ->where('cartfood.isPay', 0)
                                ->orderBy('cartfood.datetimeCF', 'desc')
                                ->limit(5) // Giới hạn chỉ lấy 5 bản ghi đầu tiên
                                ->get();
        return response()->json($listCartFood);
    }

    public function addCartFood($cart, $request)
    {
        try {
            DB::beginTransaction();
            $cartFood = CartFood::where('idCart', $cart->idCart)
                                ->where('idFood', $request->input('idFood'))
                                ->where('isPay', 0)
                                ->first();
            $food = Food::where('idFood', $request->input('idFood'))->first();
            if ($cartFood && $food){
                $cartFood->amountCF += 1;
                $cartFood->save();
            } elseif (!$cartFood && $food){
                CartFood::create([
                    'idCart' => (integer)$cart->idCart,
                    'idFood' => (integer)$food->idFood,
                    'priceCF' => (float)$food->priceFood
                ]);
            } else{
                return false;
            }
            DB::commit();
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            return false;
        }
    }

    public function updateAmountCF($request)
    {
        try {
            DB::beginTransaction();
            $cartFood = CartFood::where('idCartFood', $request->input('idCartFood'))
                ->first();
            $cartFood->amountCF = $request->input('amount');
            $cartFood->save();
            DB::commit();
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            return false;
        }
    }

    public function checkRemaining($idFood)
    {
        $sumBF = BookingFood::join('bookingtable', 'bookingfood.idBookingTable', '=', 'bookingtable.idBookingTable')
            ->where('bookingtable.dateBT', now()->toDateString())
            ->where('bookingfood.idFood', $idFood)
            ->where('bookingtable.isCheckin', 1)
            ->sum('bookingfood.amountBF');
        $sumCF = CartFood::whereDate('datetimeCF', now()->toDateString())
            ->where('isPay', 1)
            ->where('idFood', $idFood)
            ->sum('amountCF');
        $food = Food::where('idFood', $idFood)->first();
        $remaining = $food->amountFood - $sumCF - $sumBF;
        return $remaining;
    }

    public function deleteCartFood($idCartFood)
    {
        try {
            DB::beginTransaction();
            $cartFood = CartFood::find($idCartFood);
            if($cartFood && $cartFood->isPay == 0){
                $cartFood->delete();
            }
            DB::commit();
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }
}
