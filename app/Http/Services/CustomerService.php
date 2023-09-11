<?php

namespace App\Http\Services;
use App\Models\Customer;
use Exception;
class CustomerService
{
    public function create($idUser)
    {
        try {
            Customer::create([
                'idUser' => $idUser,
                // Other fields if needed
            ]);
            // Other logic if needed
        } catch (Exception $ex) {
            Session()->flash('error', $ex->getMessage());
            return null;
        }
    }

    public function getAll()
    {
        $listCustomer = Customer::join('user', 'user.idUser', '=', 'customer.idUser')->distinct()->paginate(5);
        return $listCustomer;
    }
}
