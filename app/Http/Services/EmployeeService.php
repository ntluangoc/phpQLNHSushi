<?php

namespace App\Http\Services;

use App\Models\Account;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function getAll()
    {
        $listEmployee = Employee::join('user', 'user.idUser', '=', 'employee.idUser')->get();
        return $listEmployee;
    }

    public function search($request)
    {
        $nameSearch = $request->input('nameSearch');
        $listEmployee = Employee::join('user', 'user.idUser', '=', 'employee.idUser')
                                ->where('nameUser','like', "%$nameSearch%")
                                ->get();
        return $listEmployee;
    }
    public function add($request)
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
            if ($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $newFileName = $user->idUser . '_' . date('Ymd_His') . '.' . $file->extension();

                // Lưu file ảnh mới vào thư mục đích
                $file->move(public_path('upload/user'), $newFileName);
                $user->avatar = $newFileName;
            }
            $idUser = $user->idUser;

            $password = Carbon::parse($user->birthday)->format('dmY');

            $accountService = new AccountService();
            $idAccount = $accountService->createEmployee($idUser, $request->input('phone'), $password);

            Employee::create([
                'idUser' => $user->idUser,
                'salary' => (float)$request->input('salary'),
                'position' => $request->input('position')
            ]);
            DB::commit();

            Session()->flash('success', 'Create new employee successfully');

            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }
    public function edit($idEmployee,$request)
    {
        try {
            DB::beginTransaction();
            $employee = Employee::join('user', 'user.idUser', '=', 'employee.idUser')
                ->where('idEmployee', $idEmployee)
                ->first();
            $user = User::find($employee->idUser);
            $oldFileName = (string)$request->input('oldFileName');
            $userExisted = User::where('phone', $request->input('phone'))->first();
            if ($userExisted && $userExisted->phone != $user->phone){
                Session()->flash('error', 'Phone was existed!');
                return false;
            }
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
                Session()->flash('success', 'Update information successfull');
            } else{
                Session()->flash('success', 'Update information successfully');
            }
            $account->password = bcrypt($password);
            $account->save();
            $employee->salary = (float)$request->input('salary');
            $employee->position = $request->input('position');
            $employee->save();
            DB::commit();
            Session()->flash('success', 'Update employee successfully');
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            Session()->flash('error',$ex->getMessage());
            return false;
        }
    }

    public function delete($idUser)
    {
        $user = User::find($idUser);
        if ($user->avatar && file_exists(public_path('upload/user/' . $user->avatar))) {
            unlink(public_path('upload/user/' . $user->avatar));
        }
        $user->delete();
        Session()->flash('success', 'Delete employee successfully');
    }
}
