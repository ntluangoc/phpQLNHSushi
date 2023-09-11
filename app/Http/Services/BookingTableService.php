<?php

namespace App\Http\Services;

use App\Models\BookingTable;
use App\Models\Customer;
use App\Models\Table;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingTableService
{
    public function addBookingTable($request)
    {
        try {
            DB::beginTransaction();
            $table = Table::where('typeTable', $request->input('typeTable'))->first();
            $user = Auth::user();
            BookingTable::create([
               'idUser' => $user->idUser,
                'idTable' => $table->idTable,
                'amountBT' => $request->input('amountBT'),
                'dateBT' => Carbon::parse($request->input('dateBT')),
                'timeBT' => Carbon::parse($request->input('timeBT'))->format('H:i:s'),
                'noteBT' => $request->input('noteBT')
            ]);
            DB::commit();
            Session()->flash('success', 'Booking table successfully');
            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }

    public function editBookingTable($bookingTable,$request)
    {
        try {
            DB::beginTransaction();
            $table = Table::where('typeTable', $request->input('typeTable'))->first();
            $bookingTable->idTable = $table->idTable;
            $bookingTable->amountBT = $request->input('amountBT');
            $bookingTable->dateBT = Carbon::parse($request->input('dateBT'));
            $bookingTable->timeBT = Carbon::parse($request->input('timeBT'))->format('H:i:s');
            $bookingTable->noteBT = $request->input('noteBT');
            $bookingTable->save();
            DB::commit();
            Session()->flash('success', 'Update booking table successfully');
            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }

    public function listBookingTable($date)
    {
        $listBookingTable = BookingTable::join('user', 'bookingtable.idUser', '=', 'user.idUser')
                                        ->join('table', 'bookingtable.idTable', '=', 'table.idTable')
                                        ->where('dateBT', $date)
                                        ->get();
        if ($listBookingTable)
        return $listBookingTable;
        else return null;
    }

    public function confirmBookingTable($request)
    {
        try {
            DB::beginTransaction();
            $bookingTable = BookingTable::where('idBookingTable', $request->input('id'))->first();
            $bookingTable->isCheckin = true;
            $bookingTable->save();
            $this->updateAmountBooking($bookingTable->idUser);
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }

    }

    public function updateAmountBooking($idUser)
    {
        $customer = Customer::where('idUser', $idUser)->first();
        $count = BookingTable::where('idUser', $idUser)
                            ->where('isCheckin', 1)
                            ->count();
        $customer->amountBooking = $count;
        $customer->save();
    }

    public function deleteBookingTable($idBookingTable)
    {
        try {
            DB::beginTransaction();
            $bookingTable = BookingTable::where('idBookingTable', $idBookingTable)->first();
            $idUser = $bookingTable->idUser;
            $bookingTable->delete();
            $this->updateAmountBooking($idUser);
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }
}
