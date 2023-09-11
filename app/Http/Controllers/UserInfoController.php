<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Models\BookingTable;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    //
    public function edit(User $user)
    {
        $account = Auth::user();
        if ($account->role != 'ADMIN' && $account->idUser != $user->idUser){
            abort(403, 'Access denied');
        } else{
            return view('userinfo.editUser',[
                'title'=>'Edit information',
                'user'=>$user
            ]);
        }
    }

    public function postedit(User $user,UserRequest $request)
    {
        $result = $this->userService->edit($user,$request);
        if ($result){
            return redirect('/');
        } else{
            return redirect()->back();
        }
    }

    public function infoPage($idUser)
    {
        session()->put('previous_url', 'information/'.$idUser);
        $user = User::where('idUser', $idUser)->first();
        $account = Auth::user();
        $customer = Customer::where('idUser', $idUser)->first();
        $employee = Employee::where('idUser', $idUser)->first();
        if ($account->role == 'CUSTOMER' && $account->idUser != $idUser){
            abort(403, 'Access denied');
        }
        if ($customer){
            $listBookingTable = BookingTable::leftJoin('bill', 'bookingtable.idBookingTable', '=', 'bill.idBookingTable')
                                            ->leftJoin('table', 'bookingtable.idTable', '=', 'table.idTable')
                                            ->where('bookingtable.idUser', $idUser)
                                            ->select('bookingtable.*', 'table.typeTable', 'bill.idBill')
                                            ->get();
            return view('userinfo.information',[
                'title'=>'Information',
                'user'=>$user,
                'account'=>$account,
                'customer'=>$customer,
                'listBookingTable'=>$listBookingTable
            ]);
        } elseif ($employee){
            return view('userinfo.information',[
                'title'=>'Information',
                'user'=>$user,
                'account'=>$account,
                'employee'=>$employee
            ]);
        } else{
            return view('userinfo.information',[
                'title'=>'Information',
                'account'=>$account,
                'user'=>$user
            ]);
        }
    }
}
