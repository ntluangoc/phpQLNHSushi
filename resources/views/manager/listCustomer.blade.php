@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/TH_listCustomer.css') }}">

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
                                <!-- Main-->
                                <ul class="filters" style="position: absolute; left: 50%; transform: translateX(-50%);">
                                    <div class="filter-active"></div>
                                    <li class="filter" data-filter=".all, .employee, .chef">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/listCus.png') }}"
                                             alt="">
                                        <a href="" style="text-decoration: none; color: #fff;">List Customers</a>
                                    </li>
                                </ul>
                                <!-- Search Human -->
                                <ul class="filters search-button">
                                    @if ($user->role == 'ADMIN')
                                    <form action="/admin/searchCusByName" style="display:flex">
                                        <input type="text" class="search-input" name="nameSearch" @if(isset($nameSearch)) value="{{$nameSearch}}" @endif  placeholder="Search by name ...">
                                        <button type="submit" class="search-icon">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                    @else
                                        <form action="/employee/searchCusByPhone" style="display:flex">
                                            <input type="text" class="search-input" name="phoneSearch" @if(isset($phoneSearch)) value="{{$phoneSearch}}" @endif placeholder="Search by phone ...">
                                            <button type="submit" class="search-icon">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    @endif
                                </ul>

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
                                <th scope="col" style="min-width: 50px;width: 4%;">No</th>
                                <th scope="col" style="min-width: 200px;width: 18%;">Name</th>
                                <th scope="col" style="min-width: 150px; width: 13%;">Birthday</th>
                                <th scope="col" style="min-width: 150px; width: 13%;">Phone</th>
                                <th scope="col" style="min-width: 250px; width: 22%;">Address</th>
                                <th scope="col" style="min-width: 250px; width: 22%;">Amount Booking</th>
                                <th scope="col" style="min-width: 150px; width: 13%;">Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($listCustomer))
                                @foreach($listCustomer as $customer)
                                <tr>
                                    <td style="min-width: 50px;width: 4%;">{{$loop->iteration}}</td>
                                    <td style="min-width: 200px;width: 18%;">{{$customer->nameUser}}</td>
                                    <td style="min-width: 150px; width: 13%;">{{$customer->birthday}}</td>
                                    <td style="min-width: 150px; width: 13%;">{{$customer->phone}}</td>
                                    <td style="min-width: 250px; width: 22%;;" class="note-order">{{$customer->address}}</td>
                                    <td style="min-width: 250px; width: 22%;" class="name-order">{{$customer->amountBooking}}</td>
                                    <td style="min-width: 150px; width: 13%;">
                                        <a href="/information/{{$customer->idUser}}" class="btn btn-outline-success" style="padding: 5px 10px;">
                                            <i class="fa-sharp fa-regular fa-eye fa-xs"></i>
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                @if(!isset($customer))
                                    <p>You can only search customer with phone!!!</p>
                                @else
                                    @if(!$customer)
                                        <p>No customer matches!!!</p>
                                    @else
                                    <tr>
                                        <td style="min-width: 50px;width: 4%;">1</td>
                                        <td style="min-width: 200px;width: 18%;">{{$customer->nameUser}}</td>
                                        <td style="min-width: 150px; width: 13%;">{{$customer->birthday}}</td>
                                        <td style="min-width: 150px; width: 13%;">{{$customer->phone}}</td>
                                        <td style="min-width: 250px; width: 22%;;" class="note-order">{{$customer->address}}</td>
                                        <td style="min-width: 250px; width: 22%;" class="name-order">{{$customer->amountBooking}}</td>
                                        <td style="min-width: 150px; width: 13%;">
                                            <a href="/information/{{$customer->idUser}}" class="btn btn-outline-success" style="padding: 5px 10px;">
                                                <i class="fa-sharp fa-regular fa-eye fa-xs"></i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                @endif
                            @endif
                            </tbody>
                        </table>

                        <!--  -->
                    </div>
                    @if (isset($listCustomer))
                    <div class="container">
                        {!! $listCustomer->links() !!}
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!-- Menu end -->

    <!-- gsap  -->
    <script src="{{ asset('assets/javascript/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/javascript/TH_QL_quanlyNV.js') }}"></script>
@endsection
