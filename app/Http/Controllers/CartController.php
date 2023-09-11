<?php

namespace App\Http\Controllers;

use App\Http\Services\CartFoodService;
use App\Http\Services\CartService;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\Customer;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;
    protected $cartFoodService;
    public function __construct(CartService $cartService, CartFoodService $cartFoodService)
    {
        $this->cartService = $cartService;
        $this->cartFoodService = $cartFoodService;
    }
    //
    public function getNumCart()
    {
        if (Auth::check()){
            $user = Auth::user();
        } else{
            $user = null;
        }
        $result = $this->cartFoodService->getNumCart($user);
        return $result;
    }
    public function getTop5Cart()
    {
        if (Auth::check()){
            $user = Auth::user();
        } else{
            $user = null;
        }
        $result = $this->cartFoodService->getTop5Cart($user);
        return $result;
    }

    public function addFoodToCart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('idUser', $user->idUser)->first();
        $result = $this->cartFoodService->addCartFood($cart, $request);
        return $result;
    }

    public function cartPage()
    {
        $user = Auth::user();
        $customer = Customer::where('idUser', $user->idUser)->first();
        $cart = Cart::where('idUser', $user->idUser)->first();
        $listCartFood = CartFood::join('food', 'cartfood.idFood', '=', 'food.idFood')
            ->where('cartfood.idCart', $cart->idCart)
            ->where('cartfood.isPay', 0)
            ->orderBy('cartfood.datetimeCF', 'desc')
            ->get();
        return view('purchase.purchasePage',[
            'title'=>'Cart',
            'idCart' => $cart->idCart,
            'user' => $user,
            'customer' => $customer,
            'listCartFood' => $listCartFood
        ]);
    }

    public function updateAmountCF(Request $request)
    {
        $result = $this->cartFoodService->updateAmountCF($request);
        return $result;
    }

    public function checkRemaining($idFood){
        $result = $this->cartFoodService->checkRemaining($idFood);
        return $result;
    }

    public function buyNowPage($idFood)
    {
        $food = Food::where('idFood', $idFood)->first();
        $user = Auth::user();
        $cart = Cart::where('idUser', $user->idUser)->first();
        $customer = Customer::where('idUser', $user->idUser)->first();
        return view('purchase.purchasePage',[
            'title'=>'Cart',
            'idCart' => $cart->idCart,
            'user' => $user,
            'customer' => $customer,
            'food' => $food
        ]);
    }
    public function deleteCartFood($idCartFood){
        $result = $this->cartFoodService->deleteCartFood($idCartFood);
        return redirect()->back();
    }
}
