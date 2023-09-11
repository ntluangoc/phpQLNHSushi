<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Account;

class LoginController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    //
    public function index(){
        return view('welcome', [
            'title'=>'Home Page'
        ]);
    }
    public function loginPage(){
        return view('loginPage', ['title'=> 'Login Page']);
    }
    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
//        echo "đã vào hàm login";
        if(Auth::attempt([
            'username'=>$request->input('username'),
            'password'=>$request->input('password')
        ]))
        {
            Session()->flash('success','Login successfully');
            $account = Auth::user();
            if ($account->role == 'ADMIN'){
                return redirect()->route('admin');
            } elseif ($account->role == 'EMPLOYEE'){
                return redirect()->route('employee');
            } else{
                return redirect()->route('customer');
            }
        } else {
            Session()->flash('error','Username or password is not correct!');
            return redirect()->back();
        }
    }
    public function getInfoUser(){
        if (Auth::check()) {
            $account = Auth::user();
            $idAccount = $account->idAccount;
            $user = Account::join('user', 'account.idUser', '=', 'user.idUser')
                ->where('account.idAccount', $idAccount)
                ->first();
            return $user;
        } else {
            return null;
        }
    }
    public function logout(){
        Auth::logout();
        Session()->flash('success','Logout successfully');
        return redirect('/loginPage');
    }

    public function signUp(UserRequest $request)
    {
        echo "đã chạy vào hàm đăng ký";
        $idAccount = $this->userService->create($request);
        if ($idAccount){
            Auth::loginUsingId($idAccount);
            return redirect()->route('customer');
        } else{
            return redirect()->back();
        }
    }
    public function cancel(){
        $previousUrl = session()->get('previous_url');
        // Nếu đường dẫn trước đó không tồn tại hoặc trống, thì chuyển hướng về một trang mặc định
        if (!$previousUrl) {
            return redirect('/');
        }

        // Chuyển hướng người dùng về trang trước đó
        return redirect($previousUrl);
    }
}
