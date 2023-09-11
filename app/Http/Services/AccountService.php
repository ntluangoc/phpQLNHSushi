<?php

namespace App\Http\Services;
use App\Models\Account;
use Exception;

class AccountService
{
    public function create($idUser, $username, $password)
    {
        try {
            $account = Account::create([
                'idUser' => $idUser,
                'username' => $username,
                'password' => bcrypt($password),
                'role' => 'CUSTOMER'
            ]);
            $idAccount = $account->idAccount;
            return $idAccount;
        } catch (Exception $ex) {
            Session()->flash('error', $ex->getMessage());
            return null;
        }
    }
    public function createEmployee($idUser, $username, $password)
    {
        try {
            $account = Account::create([
                'idUser' => $idUser,
                'username' => $username,
                'password' => bcrypt($password),
                'role' => 'EMPLOYEE'
            ]);
            $idAccount = $account->idAccount;
            return $idAccount;
        } catch (Exception $ex) {
            Session()->flash('error', $ex->getMessage());
            return null;
        }
    }
}
