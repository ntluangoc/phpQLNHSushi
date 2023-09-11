<?php

namespace App\Http\Controllers;

use App\Http\Services\CustomerService;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    //
    public function index()
    {
        $user = Auth::user();
        return view('manager.listCustomer',[
            'title'=>'List Customer',
            'listCustomer' => $this->customerService->getAll(),
            'user'=>$user
        ]);
    }
    public function indexWithEmployee()
    {
        $user = Auth::user();
        return view('manager.listCustomer',[
            'title'=>'List Customer',
            'user'=>$user
        ]);
    }
    public function searchByName(Request $request)
    {
        $user = Auth::user();
        $nameSearch = $request->input('nameSearch');
        $listCustomer = Customer::join('user', 'user.idUser', '=', 'customer.idUser')
            ->where('nameUser', 'like', "%$nameSearch%")
            ->orderBy('nameUser', 'asc')
            ->paginate(5);

        return view('manager.listCustomer', [
            'title' => 'Search Customer',
            'listCustomer' => $listCustomer->withQueryString(),
            'user' => $user,
            'nameSearch' => $nameSearch
        ]);
    }
    public function searchByPhone(Request $request)
    {
        $user = Auth::user();
        $phoneSearch = $request->input('phoneSearch');
        $customer = Customer::join('user', 'user.idUser', '=', 'customer.idUser')
            ->where('phone',  $phoneSearch)
            ->first();

        return view('manager.listCustomer', [
            'title' => 'Search Customer',
            'customer' => $customer,
            'user' => $user,
            'phoneSearch' => $phoneSearch
        ]);
    }
}
