<?php

namespace App\Http\Services;

use App\Models\Bill;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\Food;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillService
{
    public function addBillWithCart($request)
    {
        try {
            DB::beginTransaction();
            $listCartFood = $request->input('arrIdCartFood');
            $date = Carbon::now();
            $dateBill = $date->format('Y-m-d');
            $timeBill = $date->format('H:i:s');
            foreach ($listCartFood as $idCartFood){
                $cartFood = CartFood::where('idCartFood', $idCartFood)->first();
                $cartFood->datetimeCF = $date;
                $cartFood->isPay = true;
                $cartFood->save();
            }
            $bill = Bill::create([
                'idCart' => (integer)$request->input('idCart'),
                'dateBill' => $dateBill,
                'timeBill' => $timeBill,
                'sumPrice' => (float)$request->input('totalPrice'),
                'discount' => (float)$request->input('discountUser'),
                'discountGiftCode' => (float)$request->input('discountGF')
            ]);
            if (!$bill){
                return 0;
            }
            DB::commit();
            Session()->flash('success', 'Purchase cart successfully');
            return $bill->idBill;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return 0;
        }

    }

    public function getBill($idBill)
    {
        $bill = Bill::where('idBill', $idBill)->first();
        return $bill;
    }

    public function addBillWithBookingTable($request)
    {
        try {
            DB::beginTransaction();
            $date = Carbon::now();
            $dateBill = $date->format('Y-m-d');
            $timeBill = $date->format('H:i:s');
            $bill = Bill::create([
                'idBookingTable' => (integer)$request->input('idBookingTable'),
                'dateBill' => $dateBill,
                'timeBill' => $timeBill,
                'sumPrice' => (float)$request->input('totalPrice'),
                'discount' => (float)$request->input('discountUser'),
                'discountGiftCode' => (float)$request->input('discountGF')
            ]);
            if (!$bill){
                return 0;
            }
            DB::commit();
            Session()->flash('success', 'Purchase booking table successfully');
            return $bill->idBill;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return 0;
        }
    }

    public function updateBillWithBookingTable($request)
    {
        try {
            DB::beginTransaction();
            $bill = Bill::where('idBill', $request->input('idBill'))->first();
            $bill->sumPrice = (float)$request->input('totalPrice');
            $bill->discount = (float)$request->input('discountUser');
            $bill->discountGiftCode = (float)$request->input('discountGF');
            $bill->save();
            DB::commit();
            Session()->flash('success', 'Update bill successfully');
            return $bill->idBill;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return 0;
        }
    }
    public function addBillWithFoodBuyNow($request){
        try {
            DB::beginTransaction();
            $date = Carbon::now();
            $dateBill = $date->format('Y-m-d');
            $timeBill = $date->format('H:i:s');
            $food = Food::where('idFood', $request->input('idFoodBuyNow'))->first();
            CartFood::create([
                'idCart' => (integer)$request->input('idCart'),
                'idFood' => (integer)$food->idFood,
                'amountCF' => (integer)$request->input('amountFoodBuyNow'),
                'datetimeCF' => $date,
                'priceCF' => (float)$food->priceFood,
                'isPay' => true
            ]);
            $bill = Bill::create([
                'idCart' => (integer)$request->input('idCart'),
                'dateBill' => $dateBill,
                'timeBill' => $timeBill,
                'sumPrice' => (float)$request->input('totalPrice'),
                'discount' => (float)$request->input('discountUser'),
                'discountGiftCode' => (float)$request->input('discountGF')
            ]);
            if (!$bill){
                return 0;
            }
            DB::commit();
            Session()->flash('success', 'Purchase food successfully');
            return $bill->idBill;
        } catch (Exception $ex){
            DB::rollBack();
            Session()->flash('error', $ex->getMessage());
            return 0;
        }
    }

    public function getListBill($date)
    {
        $listBill = Bill::where('dateBill', $date)->orderBy('dateBill', 'desc')->paginate(5);
        return $listBill;
    }

    public function getListCartBill($date)
    {
        $user = Auth::user();
        $cart = Cart::where('idUser', $user->idUser)->first();
        $listBill = Bill::where('dateBill', $date)
            ->where('idCart', $cart->idCart)
            ->orderBy('dateBill', 'desc')->paginate(5);
        return $listBill;
    }
}
