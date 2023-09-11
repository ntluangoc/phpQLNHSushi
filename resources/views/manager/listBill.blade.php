@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/TH_listCartBill.css') }}">
@endsection
@section('content')


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
                                        @if ($user->role == 'CUSTOMER')
                                        <a  style="text-decoration: none; color: #fff">List Cart Bill</a>
                                        @else
                                        <a  style="text-decoration: none; color: #fff">List Bill</a>
                                        @endif
                                    </li>
                                </ul>
                                <!-- Search Date -->
                                <div style="position: absolute !important;right: 0;">
                                    <form method="post" style="display:flex; align-items:center" action="">
                                        <div class="filters search-button">
                                            <!-- Hiển thị kết quả tìm kiếm -->

                                                @csrf
                                                <input type="date" class="search-input" name="dateSearch" value="{{$date}}" placeholder="Search here ...">
                                                <button type="submit" class="search-icon" style="padding: 10px;">
                                                    <i class="fa fa-search"></i>
                                                </button>

                                        </div>
                                    </form>
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
                                <th scope="col" style="min-width: 80px;width: 7.5%;">TotalPrice</th>
                                <th scope="col" style="min-width: 80px; width: 7.5%;">Date</th>
                                <th scope="col" style="min-width: 70px; width: 6.5%; text-align: center;">Time</th>
                                <th scope="col" style="min-width: 100px; width: 9%; border-bottom: none;  text-align: center;">Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listBill as $bill)
                            <tr>
                                <td style="min-width: 50px;width: 4.5%; text-align: center;">{{$loop->iteration}}</td>
                                <td style="min-width: 80px; width: 7.5%;">{{$bill->sumPrice}}$</td>
                                <td style="min-width: 80px; width: 7.5%;">{{$bill->dateBill}}</td>
                                <td style="min-width: 70px;width: 6.5%;; text-align: center;" class="timeBill">{{$bill->timeBill}}</td>
                                <td style="min-width: 120px; width: 11%;  text-align: center;">
                                    <a href="/bill/{{$bill->idBill}}" class="btn btn-outline-success" style="padding: 5px 10px;">
                                    <i class="fa-sharp fa-regular fa-eye fa-xs"></i>
                                    View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $listBill->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- gsap  -->
    <script src="{{ asset('assets/javascript/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/javascript/main.js') }}"></script>
    <script src="{{ asset('assets/javascript/TH_listCartBill.js') }}"></script>

@endsection
