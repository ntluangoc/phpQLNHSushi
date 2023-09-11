@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/T_Restaurant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
@endsection
@section('content')
    <section style="background-image: url({{ asset('assets/images/menu-bg.png') }});" class="our-menu section bg-light repeat-img"id="menu">
        <div class="div_restaurant">
                <div id="header_restaurant">
                    <div class="thong_tin_restaurant">
                        <div class="logo_restaurant">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 210px;">
                            <div></div>
                        </div>
                    </div>
                    <div class="chi_tiet_restaurant">
                        <div style="display: inline-flex">
                            <div></div>
                            <h6 style="margin-top: 2px;">Time:</h6>
                            <form action="" method="post" style="display: flex">
                                @csrf
                                <span id="time">
                                    <span id="timeOpen">{{$restaurant->timeOpen}}</span>
                                    <span class="gach_ngang" style="margin: 0 5px;">-</span>
                                    <span id="timeClose">{{$restaurant->timeClose}}</span>
                                </span>


                            <i id="edit-icon" style="color: #ff8243; font-size: 17px; margin-left: 15px; margin-top: 2px;" class="fa fa-edit"></i>
                            <button type="submit" class="btn btn-success btn-saveTime" style="display: none; align-items: center; justify-content: center">Save</button>
                            </form>
                        </div>
                    </div>
                    <div class="content" style="display: flex; margin-top: 20px;">
                        <div class="card" style="width: 50%; margin-right: 12px; margin-left: 5px; ">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title" style="color: #ff8243;">Revenue Per Month</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">
                                        <span class="revenue-this-month"></span>
                                        <span>$</span>
                                    </span>
                                        <span>This month</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success text-revenue-month">

                                    </span>
                                        <span class="text-muted">Since last month</span>
                                    </p>
                                </div>

                                <div class="position-relative mb-4">
                                    <canvas id="visitors-chart" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="width: 50%; margin-right: 5px;">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title" style="color: #ff8243;">Revenue Per Day</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">
                                        <span class="revenue-this-day"></span>
                                        <span>$</span>
                                    </span>
                                        <span>This Day</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success text-revenue-day">

                                    </span>
                                        <span class="text-muted">Since last day</span>
                                    </p>
                                </div>

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    <!-- AdminLTE -->
    <script src="{{ asset('assets/javascript/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('assets/javascript/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/javascript/T_Restaurant.js') }}"></script>
@endsection
