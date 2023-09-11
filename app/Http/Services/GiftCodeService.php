<?php

namespace App\Http\Services;

use App\Models\GiftCode;
use Exception;
use Illuminate\Support\Facades\DB;

class GiftCodeService
{
    public function getByName($nameGF)
    {
        $discount = GiftCode::where('nameGiftCode', $nameGF)->first();
        if ($discount) return $discount->discountGiftCode;
        else return null;
    }

    public function addGiftCode($request)
    {
        try {
            DB::beginTransaction();
            GiftCode::create([
               'nameGiftCode' => (string)$request->input('nameGiftCode'),
               'discountGiftCode' => (float)$request->input('discountGiftCode')
            ]);
            DB::commit();
            Session()->flash('success', 'Create giftcode successfully');
            return true;

        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }

    public function editGiftCode($request)
    {
        try {
            DB::beginTransaction();
            $giftcode = GiftCode::find($request->input('idGiftCode'));
            $giftcode->nameGiftCode = (string)$request->input('nameGiftCode');
            $giftcode->discountGiftCode = (string)$request->input('discountGiftCode');
            $giftcode->isActive = (boolean)$request->input('isActive');
            $giftcode->save();
            DB::commit();
            Session()->flash('success', 'Edit giftcode successfully');
            return true;

        } catch (Exception $ex) {
            DB::rollBack();

            Session()->flash('error', $ex->getMessage());
            return false;
        }
    }

    public function deleteGiftCode($idGiftCode)
    {
        $giftCode = GiftCode::find($idGiftCode);
        $giftCode->delete();
        Session()->flash('success', 'Delete giftcode successfully');
        return true;
    }
}
