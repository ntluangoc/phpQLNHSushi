<?php

namespace App\Http\Services;

use App\Models\Bill;
use App\Models\BookingFood;
use App\Models\BookingTable;
use App\Models\Food;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingFoodService
{
    public function getNumBookingTable($idBookingTable)
    {
        $numBookingFood = BookingFood::where('idBookingTable', $idBookingTable)->count();
        return $numBookingFood;
    }

    public function addBookingFood($request)
    {
        try {
            DB::beginTransaction();
            $food = Food::where('idFood', $request->input('idFood'))->first();
            $bookingFood = BookingFood::create([
                'idBookingTable' => $request->input('idBookingTable'),
                'idFood' => $request->input('idFood'),
                'priceBF' => $food->priceFood
            ]);
            DB::commit();
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            return false;
        }
    }
    public function updateAmountCF($request)
    {
        try {
            DB::beginTransaction();
            $bookingFood = BookingFood::where('idBookingFood', $request->input('idBookingFood'))
                ->first();
            $bookingFood->amountCF = $request->input('amount');
            $bookingFood->save();
            DB::commit();
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            return false;
        }
    }

    public function deleteBookingFood($idBookingFood)
    {
        try {
            DB::beginTransaction();
            $bookingFood = BookingFood::find($idBookingFood);
            $bookingTable = BookingTable::find($bookingFood->idBookingTable);
            $bill = Bill::where('idBookingTable', $bookingFood->idBookingTable)->first();
            $user = Auth::user();
            if ($bill && $user->role=='ADMIN'){
                $bookingFood->delete();
            } elseif (!$bill){
                if ($bookingTable->isCheckin == 1 && $user->role != 'CUSTOMER'){
                    $bookingFood->delete();
                } elseif($bookingTable->isCheckin == 0){
                    $bookingFood->delete();
                }
            }
            DB::commit();
            return true;
        } catch (Exception $ex){
            DB::rollBack();
            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }
}
