@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/TH_detailCustomer.css') }}">
@endsection
@section('content')
    <section style="background-image: url({{ asset('assets/images/menu-bg.png') }});" class="our-menu section bg-light repeat-img"
             id="menu">
        <div class="sec-wp">
            <div class="container">
                <div class="menu-tab-wp">
                    <div class="row">
                        <div class="col-lg-12 m-auto">
                            <div class="menu-tab text-center">
                                <!-- Main  -->
                                @if (isset($listBookingTable))
                                <ul class="filters" style="position: absolute; left: 50%; transform: translateX(-50%);">
                                    <div class="filter-active"></div>
                                    <li class="filter" data-filter=".all, .employee, .chef">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/listBooking.png') }}"
                                             alt="">
                                        List Booking
                                    </li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -->
                <div class="body-detail" style="display: flex;justify-content: space-around;">
                    <div class="detail-list" style="margin-top: -10%;">
                        <div class="dish-box text-center">
                            <div class="dist-img">
                                @if (!$user->avatar)
                                <img src="{{ asset('upload/user/user.png') }}" alt="">
                                @else
                                <img src="{{ asset('upload/user/'.$user->avatar) }}" alt="">
                                @endif
                            </div>
                            <div class="human-title">
                                <h3 class="h3-title">{{$user->nameUser}}</h3>
                                <tr>
                                    <th>{{$user->email}}</th>
                                </tr>
                            </div>

                            <div class="human-list">
                                <table class="human-info">
                                    <tr>
                                        <th>Birthday:</th>
                                        <td>{{$user->birthday->format('d-m-Y')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td>{{$user->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td>{{$user->address}}</td>
                                    </tr>
                                    @if (isset($customer))
                                    <tr>
                                        <th>Amount Booking:</th>
                                        <td>{{$customer->amountBooking}}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount:</th>
                                        <td>{{$customer->discount}}%</td>
                                    </tr>
                                    @elseif(isset($employee))
                                    <tr>
                                        <th>Salary:</th>
                                        <td>{{$employee->salary}}$</td>
                                    </tr>
                                    <tr>
                                        <th>Position:</th>
                                        <td>{{$employee->position}}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="dist-bottom-row" style="margin-top: 40px;">
                                <ul>
                                    @if ( (isset($customer) && $account->role != 'EMPLOYEE') || (!isset($customer)))
                                    <li >
                                        <button class="dish-add-btn btn-buy-now">
                                            <a href="/editUser/{{$user->idUser}}" style="text-decoration: none;color: white;">
                                                <i class="fa-regular fa-pen-to-square fa-lg" style="color: #fff;"></i>
                                                <span>Edit</span>
                                            </a>
                                        </button>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    @if (isset($listBookingTable))
                    <div class="info-list">

                        <!--  -->
                        <div class="info-list-wrap">
                            <table class="table table-hover table-scroll">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 4%;min-width: 40px;;">No</th>
                                    <th scope="col" style="width: 20%;min-width: 115px;">Time</th>
                                    <th scope="col" style="width: 8%;min-width: 80px;">Type</th>
                                    <th scope="col" style="min-width: 74px;width: 9%;">Amount</th>
                                    <th scope="col" style="width: 31%;min-width: 173px;">Note</th>
                                    <th scope="col" style="width: 14%;min-width: 88px;text-align: center;">Action</th>
                                    <th scope="col" style="width: 14%;min-width: 88px;text-align: center;">Food</th>
                                </tr>
                                </thead>
                                <tbody class="tbody_list">
                                @foreach($listBookingTable as $bookingTable)
                                <tr>
                                    <td style="width: 4%; min-width: 40px;">{{$loop->iteration}}</td>
                                    <td style="width: 20%;min-width: 115px;">
                                        <span>{{$bookingTable->dateBT->format('d-m-Y')}}</span>
                                        <span class="timeBT">{{$bookingTable->timeBT}}</span>
                                    </td>
                                    <td style="min-width: 80px;width: 8%;">{{$bookingTable->typeTable}} People</td>
                                    <td style="width: 9%;min-width: 74px; text-align:center">{{$bookingTable->amountBT}}</td>
                                    <td style="width: 31%;min-width: 173px;;" class="note-order">{{$bookingTable->noteBT}}</td>
                                    <td style="width: 14%;min-width: 88px; text-align:center">

                                            <a href="/editBookingTable/{{$bookingTable->idBookingTable}}" class="btn btn-success" style="padding: 5px 10px;">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                View
                                            </a>

                                    </td>
                                    <td style="width: 14%;min-width: 88px; text-align:center">
                                        @if ($account->role == 'ADMIN')
                                        <a href="/purchase/{{$bookingTable->idBookingTable}}" class="btn btn-outline-success" style="padding: 5px 5px;">
                                            <i class="fa-sharp fa-regular fa-eye fa-xs"></i>
                                            View
                                        </a>
                                        @elseif($bookingTable->idBill)
                                        <a href="/bill/{{$bookingTable->idBill}}" class="btn btn-outline-success" style="padding: 5px 5px;">
                                        <i class="fa-sharp fa-regular fa-eye fa-xs"></i>
                                        View
                                        </a>
                                        @else
                                        <a href="/purchase/{{$bookingTable->idBookingTable}}" class="btn btn-outline-success" style="padding: 5px 5px;">
                                            <i class="fa-sharp fa-regular fa-eye fa-xs"></i>
                                            View
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @if (!$listBookingTable)
                                    <tr>
                                        <td colspan="7">No booking table!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                        </div>
                        <!--  -->
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- gsap  -->
    <script src="{{ asset('assets/javascript/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/javascript/main.js') }}"></script>
    <script src="{{ asset('assets/javascript/TH_detailCustomer.js') }}"></script>

@endsection
