@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/T_GiftCode.css') }}">
@endsection
@section('content')

    <div class="div_giftcode" style="margin-top: 150px; background-image: url({{ asset('assets/images/menu-bg.png') }});">
        <form action="/admin/addeditGiftCode" method="post">
            @csrf
            <div class="container_gc">
                <h1 class="namecode">Gift Code</h1>
                <div class="info_list" style="margin-right: 20px; margin-left: 20px;">
                    <div class="info-list-wrap" style="color: #ff8243;">
                        <table class="table table-hover table-scroll">
                            <thead style="color: #ff8243;border-bottom: 2px solid #ff8243;">
                            <tr>
                                <th scope="col" style="min-width: 50px;width: 4.5%; height: 60px; text-align: center;">No</th>
                                <th scope="col" style="min-width: 70px; width: 4.5%;height: 60px;">Code</th>
                                <th scope="col" style="min-width: 80px; width: 5%; height: 60px;">Discount</th>
                                <th scope="col" style="min-width: 110px; width: 5%; height: 60px; text-align: center;">Active</th>
                                <th scope="col" style="min-width: 80px; width: 10%; height: 60px; text-align: center;">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                                @foreach($listGiftCode as $giftCode)

                                <tr>

                                    <td style="min-width: 50px;  padding-top: 15px; text-align: center;">
                                        <span>{{$loop->iteration}}</span>

                                        <p style="display:none" class="idGiftCode">{{$giftCode->idGiftCode}}</p>
                                    </td>
                                    <td style="min-width: 60px; padding-top: 15px;">
                                            <span>
                                                {{$giftCode->nameGiftCode}}
                                            </span>
                                    </td>
                                    <td style="min-width: 80px;  padding-top: 15px; padding-left:15px">{{$giftCode->discountGiftCode}}%</td>
                                    <td style="min-width: 60px;   padding-top: 15px; text-align:center">
                                        <p style="display:none" class="isActive">{{$giftCode->isActive}}</p>
                                        @if ($giftCode->isActive)
                                        <i class="fa-solid fa-circle-check fa-lg icon-active" style="padding: 15px 15px; color: #09c820; font-size: 25px;"></i>
                                        <span class="active-title">Active</span>
                                        @else
                                        <i class="fa-solid fa-circle-xmark fa-lg icon-active" style="padding: 15px 15px; color: red; font-size: 25px;"></i>
                                        <span class="active-title">Not Active</span>
                                        @endif
                                    </td>
                                    <td style="min-width: 60px; width: 10%; text-align: center; " class="group-edit-delete">

                                        <button type="button" class="btn btn-success edit-button" style="width: 85px;"><i class="fa-solid fa-pen" style="font-size: 15px;"></i> Edit</button>
                                        <button data-href="/admin/deleteGiftCode/{{$giftCode->idGiftCode}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" type="button" class="btn btn-danger" style="padding: 7.5px 5px;  margin-left: 50px;"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                                @endforeach


                            <tr>


                                <td style="min-width: 50px; text-align: center;"></td>
                                <td style="min-width: 70px;">

                                </td>
                                <td style="min-width: 80px; ">
                                </td>
                                <td style="min-width: 60px; text-align: center;"></td>
                                <td style="min-width: 60px;  text-align: center;">
                                    <button type="button" class="btn btn-success add-button" style="width: 85px;"><i class="fa-solid fa-plus" style="font-size: 15px;"></i> Add</button>
                                    <button type="submit" class="btn btn-success save-button" style="width: 85px; display: none;"><i class="fa-solid fa-check" style="font-size: 15px;"></i> Save</button>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- MODAL delete-->
    <div class="modal" tabindex="-1" id="confirm-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete giftcode?</p>
                </div>
                <div class="modal-footer">
                    <a href="/admin/listGiftCode" type="button" class="btn btn-secondary">Close</a>
                    <a class="btn btn-danger btn-delete">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/javascript/T_GiftCode.js') }}"></script>
@endsection
