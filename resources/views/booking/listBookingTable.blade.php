@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/TH_listDBByDate.css') }}">

@endsection
@section('content')
    <p style="display:none" id="dateReverse"></p>
    <section style="background-image: url({{ asset('assets/images/menu-bg.png') }});" class="our-menu section bg-light repeat-img"
             id="menu">
        <div class="sec-wp" style="height: 100%;">
            <div class="container" style="height: 100%;">

                <div class="menu-tab-wp">
                    <div class="row">
                        <div class="col-lg-12 m-auto">
                            <div class="menu-tab text-center">
                                <!-- Main  -->
                                <ul class="filters" style="position: absolute; left: 50%; transform: translateX(-50%);">
                                    <div class="filter-active"></div>
                                    <li class="filter" data-filter=".all">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/listBooking.png') }}"
                                             alt="">
                                        <a href="" style="text-decoration: none; color: #fff">List Booking</a>

                                    </li>
                                </ul>
                                <!-- Search Date -->
                                <div style="position: absolute !important;right: 0;">
                                    <div style="display:flex; align-items:center">
                                        <div class="filters search-button">
                                            <!-- Hiển thị kết quả tìm kiếm -->
                                            <form method="post" @if($user->role=='ADMIN') action="/admin/booking" @else action="/employee/booking" @endif>
                                                @csrf
                                                <input type="date" class="search-input" name="dateSearch" value="{{$date}}" placeholder="Search here ...">
                                                <button type="submit" class="search-icon" style="padding: 10px;">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="info-list">
                    <div class="info-list-wrap">
                        <table class="table table-hover table-scroll">
                            <thead>
                            <tr>
                                <th scope="col" style="min-width: 50px;width: 4.5%; text-align: center;">No</th>
                                <th scope="col" style="min-width: 70px;width: 6.5%;">Time</th>
                                <th scope="col" style="min-width: 80px; width: 7.5%;">Type</th>
                                <th scope="col" style="min-width: 80px; width: 7.5%; text-align: center;">Amount</th>
                                <th scope="col" style="min-width: 250px; width: 24%;">Note</th>
                                <th scope="col" style="min-width: 150px; width: 14.5%;">Customers</th>
                                <th scope="col" style="min-width: 120px; width: 11%;">Phone</th>
                                <th scope="col" style="min-width: 110px; width: 7%; text-align: center;">Check-in</th>
                                <th scope="col" style="min-width: 80px; width: 7%; text-align: center;">Action</th>
                                <th scope="col" style="min-width: 100px; width: 9%; border-bottom: none;  text-align: center;">Food</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if ($listBookingTable)
                                @foreach($listBookingTable as $bookingTable)
                            <tr>
                                <td style="min-width: 50px;width: 4.5%; text-align: center;">{{$loop->iteration}}</td>
                                <td style="min-width: 70px;width: 6.5%;" class="timeBT">{{$bookingTable->timeBT}}</td>
                                <td style="min-width: 80px; width: 7.5%;">{{$bookingTable->typeTable}} People</td>
                                <td style="min-width: 80px; width: 7.5%; text-align: center;">{{$bookingTable->amountBT}}</td>
                                <td style="min-width: 250px; width: 24%;" class="note-order">{{$bookingTable->noteBT}}</td>
                                <td style="min-width: 150px; width: 14.5%;" class="name-order">{{$bookingTable->nameUser}}</td>
                                <td style="min-width: 120px; width: 11%;">{{$bookingTable->phone}}</td>
                                @if ($bookingTable->isCheckin)
                                <td style="min-width: 60px; width: 5%; text-align: center;">
                                    <i class="fa-solid fa-circle-check fa-lg" style="color: #09c820;"></i>
                                </td>
                                @else
                                <td style="min-width: 60px;width: 5%; text-align: center;">
                                    <form @if($user->role=='ADMIN') action="/admin/confirm" @else action="/employee/confirm" @endif method="post">
                                        @csrf
                                        <input readonly type="number" name="id" value="{{$bookingTable->idBookingTable}}" style="display: none">
                                        <button type="submit" class="btn btn-outline-success" style="padding: 5px 5px;">
                                            Confirm
                                        </button>
                                    </form>
                                </td>
                                @endif
                                <td style="min-width: 60px; width: 5%; text-align: center;">
                                    <a href="/editBookingTable/{{$bookingTable->idBookingTable}}" class="btn btn-outline-success" style="padding: 5px 15px;">Edit</a>
                                </td>
                                <td style="min-width: 120px; width: 11%;  text-align: center;">
                                    <a href="/purchase/{{$bookingTable->idBookingTable}}" class="btn btn-outline-success" style="padding: 5px 10px;">
                                        <i class="fa-sharp fa-regular fa-eye fa-xs"></i>
                                        View
                                    </a>
                                </td>
                            </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="10">No booking table today!</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </section>

    <!-- gsap  -->
    <script src="{{ asset('assets/javascript/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/javascript/main.js') }}"></script>
    <script src="{{ asset('assets/javascript/TH_listDBByDate.js') }}"></script>

@endsection
