@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/T_BillUser.css') }}">

@endsection
@section('content')

    <div class="div_bill">
        <div id="hoa_don">
            <div class="chi_tiet_hoa_don">
                <div class="nha_hang">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 210px;">
                </div>
                <h6 class="dia_chi" >55 Giải Phóng , Hai Bà Trưng , Hà Nội</h6>
                <div></div>
            </div>
            <h5 class="hoa_don_tt">Bill</h5>
            <div class="hoa_don_thanh_toan">
                <div style="display: inline-flex">
                    <span>Code:</span> <span style="margin-left: 5px">{{$bill->idBill}}</span>
                </div>
                <div></div>
                <div></div>
                <div class="ngay_in" style="display: inline-flex">
                    <span>Date: </span>  <span style="margin-left: 5px">{{$bill->dateBill}}</span>
                    <span class="gio_in"> Time:</span> <span class="timeBill" style="margin-left: 5px">{{$bill->timeBill}}</span>
                </div>
                <div></div>
                <div class="tt_khach_hang" style="display: inline-flex">
                    <span> Customer: </span> <span style="margin-left: 5px">{{$user->nameUser}}</span>
                    <span class="sdt_khach_hang">Phone:</span> <span style="margin-left: 5px">{{$user->phone}}</span>
                </div>
            </div>
            <div class="table_list">
                <table class="table list_banAn border-dark">
                    <thead>
                    <tr>
                        <th scope="col" style="width:50px">No</th>
                        <th scope="col" style="width:100px">Type</th>
                        <th scope="col" class="col_monan">Food</th>
                        <th scope="col" style="width:100px">Price</th>
                        <th scope="col" style="width:100px">Amount</th>
                        <th scope="col" style="width:100px">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($listCartFood))
                        @foreach($listCartFood as $cartFood)
                            <tr>
                        <td style="width:50px">{{$loop->iteration}}</td>
                        <td style="width:100px">{{$cartFood->typeFood}}</td>
                        <td>{{$cartFood->nameFood}}</td>
                        <td style="width:100px">{{$cartFood->priceCF}}<span>$</span></td>
                        <td style="width:100px">{{$cartFood->amountCF}}</td>
                        <td style="width:100px">
                            <span class="index-sumPrice">{{$cartFood->priceCF * $cartFood->amountCF}}</span>
                            <span>$</span>
                        </td>
                            </tr>
                            @endforeach
                    @elseif(isset($listBookingFood))
                        @foreach($listBookingFood as $bookingFood)
                            <tr>
                                <td style="width:50px">{{$loop->iteration}}</td>
                                <td style="width:100px">{{$bookingFood->typeFood}}</td>
                                <td>{{$bookingFood->nameFood}}</td>
                                <td style="width:100px">{{$bookingFood->priceBF}}<span>$</span></td>
                                <td style="width:100px">{{$bookingFood->amountBF}}</td>
                                <td style="width:100px">
                                    <span class="index-sumPrice">{{$bookingFood->priceBF * $bookingFood->amountBF}}</span>
                                    <span>$</span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <!-- Phần tổng tiền -->
                    <tr>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0">Total:</td>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0"> </td>
                        <td class="border-bottom-0">
                            <span class="totalPrice"></span>
                            <span>$</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0" colspan="2">Discount user:</td>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0">
                            <span class="discountUser">{{$bill->discount}}</span>
                            <span>%</span>
                        </td>
                        <td class="border-bottom-0">
                            <span class="money-discountUser"></span>
                            <span>$</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0" colspan="2">Discount giftcode:</td>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0">
                            <span class="discountGiftcode">{{$bill->discountGiftCode}}</span>
                            <span>%</span>
                        </td>
                        <td class="border-bottom-0">
                            <span class="money-discountGiftcode"></span>
                            <span>$</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0">Payment:</td>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0"></td>
                        <td class="border-bottom-0" style="color: red">
                            <span>{{$bill->sumPrice}}</span>
                            <span>$</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="gach_duoi" style="top: 10px;"></div>
                <div class="phan_cuoi">
                    <div></div>
                    <h6>Please evaluate 10 points if you feel satisfied!</h6>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/javascript/L_BillUser.js') }}"></script>
@endsection
