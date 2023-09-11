<?php

namespace App\Http\Services;
use App\Models\Account;
use App\Models\User;
use Exception;
use Carbon\Carbon;
use App\Http\Services\CustomerService;
use App\Http\Services\AccountService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function create($request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'nameUser' => (string)$request->input('nameUser'),
                'birthday' => \Carbon\Carbon::parse($request->input('birthday')),
                'phone' => (string)$request->input('phone'),
                'address' => (string)$request->input('address'),
                'email' => (string)$request->input('email')
            ]);

            $idUser = $user->idUser;

            $password = Carbon::parse($user->birthday)->format('dmY');

            $accountService = new AccountService();
            $idAccount = $accountService->create($idUser, $request->input('phone'), $password);

            $customerService = new CustomerService();
            $customerService->create($idUser);
            DB::commit();

            Session()->flash('success', 'Login successfully with username: ' .$request->input('phone') .'& password: '.$password);

            return $idAccount;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return null;
        }
    }

    public function edit($user, $request)
    {
        try {
            DB::beginTransaction();
            $oldFileName = (string)$request->input('oldFileName');
            if ($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $newFileName = $user->idUser . '_' . date('Ymd_His') . '.' . $file->extension();

                //xóa ảnh cũ
                if ($oldFileName && file_exists(public_path('upload/user/' . $oldFileName))) {
                    unlink(public_path('upload/user/' . $oldFileName));
                }

                // Lưu file ảnh mới vào thư mục đích
                $file->move(public_path('upload/user'), $newFileName);
                $user->avatar = $newFileName;
            } else{
                $user->avatar = $oldFileName;
            }
            $user->nameUser = (string)$request->input('nameUser');
            $user->birthday = Carbon::parse($request->input('birthday'));
            $user->phone = (string)$request->input('phone');
            $user->address = (string)$request->input('address');
            $user->email = (string)$request->input('email');
            $user->save();
            //thay đổi username = phone và password = birthday
            $password = Carbon::parse($user->birthday)->format('dmY');
            $account = Account::where('idUser', $user->idUser)->first();
            if ($account->username != 'admin'){
                $account->username = $user->phone;
                Session()->flash('success', 'Update information successfully. '."\n".'Update username: ' .$user->phone .' & password: '.$password);
            } else{
                Session()->flash('success', 'Update information successfully. '."\n".'Update password: '.$password);
            }
            $account->password = bcrypt($password);
            $account->save();
            DB::commit();
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            Session()->flash('error',$ex->getMessage());
            return false;
        }
    }
}
