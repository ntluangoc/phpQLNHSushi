<?php

namespace App\Http\Controllers;

use App\Http\Services\BillService;
use App\Models\BookingFood;
use App\Models\BookingTable;
use App\Models\Cart;
use App\Models\CartFood;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    //
    protected $billService;
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function addBillWithCart(Request $request)
    {
        $result = $this->billService->addBillWithCart($request);
        return $result;
    }

    public function addBillWithFoodBuyNow(Request $request)
    {
        $result = $this->billService->addBillWithFoodBuyNow($request);
        return $result;
    }
    public function addBillWithBookingTable(Request $request)
    {
        $result = $this->billService->addBillWithBookingTable($request);
        return $result;
    }
    public function billPage($idBill)
    {
        $account = Auth::user();
        $bill = $this->billService->getBill($idBill);
        if ($bill->idCart){

            $cart = Cart::where('idCart', $bill->idCart)->first();
            $user = User::where('idUser', $cart->idUser)->first();
            if ($user->idUser != $account->idUser && $account->role=='CUSTOMER'){
                abort(403, 'Access denied');
            } else{
                $listCartFood = CartFood::join('food', 'cartfood.idFood', '=', 'food.idFood')
                    ->where('cartfood.idCart', $cart->idCart)
                    ->where('cartfood.datetimeCF', Carbon::parse($bill->dateBill. '' . $bill->timeBill)->format('Y-m-d H:i:s'))
                    ->where('cartfood.isPay', 1)
                    ->orderBy('cartfood.datetimeCF', 'desc')
                    ->get();
                return view('purchase.bill',[
                    'title'=>'Bill',
                    'bill' => $bill,
                    'user' => $user,
                    'listCartFood' => $listCartFood
                ]);
            }
        } else{
            $bookingTable = BookingTable::where('idBookingTable', $bill->idBookingTable)->first();
            $user = User::where('idUser', $bookingTable->idUser)->first();
            if ($user->idUser != $account->idUser && $account->role=='CUSTOMER'){
                abort(403, 'Access denied');
            } else {
                $listBookingFood = BookingFood::join('food', 'bookingfood.idFood', '=', 'food.idFood')
                    ->where('bookingfood.idBookingTable', $bookingTable->idBookingTable)
                    ->get();
                return view('purchase.bill', [
                    'title' => 'Bill',
                    'bill' => $bill,
                    'user' => $user,
                    'listBookingFood' => $listBookingFood
                ]);
            }
        }
    }

    public function updateBillWithBookingTable(Request $request)
    {
        $result = $this->billService->updateBillWithBookingTable($request);
        return $result;
    }

    public function listBill()
    {
        $date = Carbon::now()->format('Y-m-d');
        $user = Auth::user();
        if ($user->role == 'CUSTOMER'){
            $listBill = $this->billService->getListCartBill($date);
            return view('manager.listBill', [
                'title' => 'Cart Bill',
                'listBill' => $listBill,
                'user' => $user,
                'date' => $date
            ]);
        } else{
            $listBill = $this->billService->getListBill($date);
            return view('manager.listBill', [
                'title' => 'Bill',
                'listBill' => $listBill,
                'user' => $user,
                'date' => $date
            ]);
        }
    }

    public function listBillByDate(Request $request)
    {
        $date = $request->input('dateSearch');
        $user = Auth::user();
        if ($user->role == 'CUSTOMER'){
            $listBill = $this->billService->getListCartBill($date);
            return view('manager.listBill', [
                'title' => 'Cart Bill',
                'listBill' => $listBill,
                'user' => $user,
                'date' => $date
            ]);
        } else{
            $listBill = $this->billService->getListBill($date);
            return view('manager.listBill', [
                'title' => 'Bill',
                'listBill' => $listBill,
                'user' => $user,
                'date' => $date
            ]);
        }
    }

}
