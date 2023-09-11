<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingTableRequest;
use App\Http\Services\BookingFoodService;
use App\Http\Services\BookingTableService;
use App\Http\Services\FoodService;
use App\Models\Bill;
use App\Models\BookingFood;
use App\Models\BookingTable;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //
    protected $bookingTableService;
    protected $bookingFoodService;
    protected $foodService;
    public function __construct(BookingTableService $bookingTableService, BookingFoodService $bookingFoodService, FoodService $foodService)
    {
        $this->bookingTableService = $bookingTableService;
        $this->bookingFoodService = $bookingFoodService;
        $this->foodService = $foodService;
    }

    public function addBookingTablePage()
    {
        $user = Auth::user();
        return view('booking.addEditBookingTable',[
            'title'=>'Add booking Table',
            'user' => $user
        ]);
    }
    public function postAddBookingTable(Request $request)
    {
        $result = $this->bookingTableService->addBookingTable($request);
        if ($result){
            return redirect('/');
        } else{
            return redirect()->back();
        }
    }

    public function editBookingTablePage(BookingTable $bookingTable)
    {
        $user = Auth::user();
        if ($user->idUser != $bookingTable->idUser && $user->role == 'CUSTOMER'){
            abort(403, 'Access denied');
        } else
            return view('booking.addEditBookingTable',[
                'title'=>'Update booking Table',
                'user' => $user,
                'bookingTable' => $bookingTable
            ]);
    }

    public function posteditBookingTable(BookingTable $bookingTable, Request $request)
    {
        $result = $this->bookingTableService->editBookingTable($bookingTable, $request);
        if ($result) return redirect(session()->get('previous_url'));
        else return redirect()->back();
    }

    public function listBookingTable()
    {
        $user = Auth::user();
        session()->put('previous_url', url()->current());
        $date = Carbon::now()->format('Y-m-d');
        $result = $this->bookingTableService->listBookingTable($date);
        return view('booking.listBookingTable',[
            'title'=>'List Booking Table',
            'listBookingTable' => $result,
            'date'=>$date,
            'user' => $user
        ]);
    }
    public function searchListBookingTable(Request $request)
    {
        $user = Auth::user();

        session()->put('previous_url', url()->current());

        $date = Carbon::parse($request->input('dateSearch'))->format('Y-m-d');
        $result = $this->bookingTableService->listBookingTable($date);
        return view('booking.listBookingTable',[
            'title'=>'List Booking Table',
            'listBookingTable' => $result,
            'date'=>$date,
            'user' => $user
        ]);
    }

    public function confirm(Request $request)
    {
        $result = $this->bookingTableService->confirmBookingTable($request);
        return redirect()->back();
    }

    public function purchaseBookingTablePage($idBookingTable)
    {
        session()->put('previous_url', '/purchase/'.$idBookingTable);
        $user = Auth::user();
        $bookingTable = BookingTable::where('idBookingTable', $idBookingTable)->first();
        if ($user->idUser != $bookingTable->idUser && $user->role=='CUSTOMER'){
            abort(403, 'Access denied');
        }else{
            $isCheckin = $bookingTable->isCheckin;
            $customer = Customer::where('idUser', $bookingTable->idUser)->first();
            $listBookingFood = BookingFood::join('food', 'bookingfood.idFood', '=', 'food.idFood')
                ->where('bookingfood.idBookingTable', $idBookingTable)
                ->get();
            $bill = Bill::where('idBookingTable', $idBookingTable)->first();
            if ($bill){
                return view('purchase.purchasePage',[
                    'title'=>'Purchase',
                    'idBookingTable' => $idBookingTable,
                    'isCheckin' => $isCheckin,
                    'user' => $user,
                    'customer' => $customer,
                    'listBookingFood' => $listBookingFood,
                    'bill' => $bill
                ]);
            } else{

                return view('purchase.purchasePage',[
                    'title'=>'Purchase',
                    'idBookingTable' => $idBookingTable,
                    'isCheckin' => $isCheckin,
                    'user' => $user,
                    'customer' => $customer,
                    'listBookingFood' => $listBookingFood
                ]);
            }
        }
    }
    public function getNumBookingFood($idBookingTable){
        $result = $this->bookingFoodService->getNumBookingTable($idBookingTable);
        return $result;
    }

    public function addBookingFoodPage($idBookingTable)
    {
        $user = Auth::user();
        return view('menu.menu',[
            'title'=>'Menu',
            'foods' => $this->foodService->getAll(),
            'user' => $user,
            'idBookingTable' => $idBookingTable
        ]);
    }

    public function postAddBookingFood(Request $request)
    {
        $result = $this->bookingFoodService->addBookingFood($request);
        return $result;
    }

    public function updateAmountBF(Request $request)
    {
        $result = $this->bookingFoodService->updateAmountCF($request);
        return $result;
    }

    public function deleteBookingFood($idBookingFood)
    {
        $this->bookingFoodService->deleteBookingFood($idBookingFood);
        return redirect()->back();
    }

    public function deleteBookingTable($idBookingTable)
    {
        $this->bookingTableService->deleteBookingTable($idBookingTable);
        return redirect()->route('cancel');
    }
}
