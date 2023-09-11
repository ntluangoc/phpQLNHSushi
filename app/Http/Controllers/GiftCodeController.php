<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftCodeRequest;
use App\Http\Services\GiftCodeService;
use App\Models\GiftCode;
use Illuminate\Http\Request;

class GiftCodeController extends Controller
{
    protected $giftCodeService;
    public function __construct(GiftCodeService $giftCodeService)
    {
        $this->giftCodeService = $giftCodeService;
    }
    //
    public function getGiftCode($nameGF)
    {
        $result = $this->giftCodeService->getByName($nameGF);
        return $result;
    }

    public function getListGiftCode()
    {
        $listGiftCode = GiftCode::get();
        return view('manager.giftcode',[
            'title'=>'List GiftCode',
            'listGiftCode' => $listGiftCode
        ]);
    }

    public function addGiftCode(GiftCodeRequest $request)
    {
        if($request->input('idGiftCode')){
            $result = $this->giftCodeService->editGiftCode($request);
        } else $result = $this->giftCodeService->addGiftCode($request);
        return redirect()->back();
    }

    public function deleteGiftCode($idGiftCode)
    {
        $result = $this->giftCodeService->deleteGiftCode($idGiftCode);
        return redirect()->back();
    }
}
