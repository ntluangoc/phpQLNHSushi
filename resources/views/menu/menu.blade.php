@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/L_menu.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!-- Menu begin -->
    <section style="background-image: url({{ asset('assets/images/menu-bg.png') }});" class="our-menu section bg-light repeat-img"
             id="menu">
        <div class="sec-wp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sec-title text-center mb-2">
                            <p class="sec-sub-title mb-3">our menu</p>
                            <div class="sec-title-shape mb-4">
                                <img src="{{ asset('assets/images/title-shape.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-tab-wp" style="position: relative;">
                    <div class="row">
                        <div class="col-lg-12 m-auto">
                            <div class="menu-tab text-center">
                                <ul class="filters">
                                    <div class="filter-active"></div>
                                    <li class="filter" data-filter=".all, .Starter, .MainCourse, .Dessert">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/menu-1.png') }}" alt="">
                                        All
                                    </li>
                                    <li class="filter" data-filter=".Starter">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/sushi_1.png') }}" alt="">
                                        Starter
                                    </li>
                                    <li class="filter" data-filter=".MainCourse">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/sushi_2.png') }}" alt="">
                                        Main course
                                    </li>
                                    <li class="filter" data-filter=".Dessert">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/Dessert.png') }}" alt="">
                                        Dessert
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if ($user && $user->role == 'ADMIN' && !isset($idBookingTable))
                    <a href="/admin/addFood" class="div_add_food">
                        <div class="div_color_add_food">
                            <i class="fa-solid fa-plus"></i>
                            <span>Add food</span>
                        </div>
                    </a>
                    @endif
                    @if (isset($idBookingTable))
                    <span id="idBookingTable" style="display:none">{{$idBookingTable}}</span>
                    <a onclick="location.href='{{ route('cancel') }}'" class="div_add_food">
                        <div class="div_color_add_food" style="justify-content: center;">
                            <img src="{{ asset('assets/images/icon_back_fill.png') }}" alt="">
                            <span style="font-size: 20px;">Return</span>
                        </div>
                    </a>
                    @endif
                </div>
                <div class="menu-list-row">
                    <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                        @foreach($foods as $food)
                        <div class="col-lg-4 col-sm-6 dish-box-wp {{ str_replace(' ', '', $food->typeFood) }}" data-cat="{{ str_replace(' ', '', $food->typeFood) }}">
                        <div class="dish-box text-center">
                            <div class="dist-img">
                                @if ($food->imgFood)
                                    <img src="{{ asset('upload/menu/'.$food->imgFood) }}" alt="">
                                @else
                                    <img src="{{ asset('upload/menu/demo.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="dish-title">
                                <h3 class="h3-title">{{$food->nameFood}}</h3>
                            </div>
                            <div>
                                <p>For
                                    <span>{{$food->typeFood}}</span>
                                </p>
                            </div>
                            <div class="dish-info">
                                <ul style="padding:0">
                                    <li>
                                        <p>Price</p>
                                        <b class="price">{{$food->priceFood}}
                                            <span>$<span>
                                        </b>
                                    </li>
                                    <li>
                                        <p>Person</p>
                                        <b>{{$food->forPerson}}

                                        </b>
                                    </li>
                                </ul>
                            </div>
                            <div class="dist-bottom-row">
                                <ul>
                                    @if ($user && $user->role == 'ADMIN' && !isset($idBookingTable))
                                    <li>
                                        <a href="/admin/editFood/{{$food->idFood}}">
                                            <button class="dish-add-btn btn-buy-now">
                                                <img src="{{ asset('assets/images/icon_pencil_line.png') }}"
                                                     class="uil uil-plus">
                                                <span>Edit</span>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <button data-idfood="{{$food->idFood}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="dish-add-btn delete-btn">
                                            <img src="{{ asset('assets/images/icon_delete_2_line.png') }}"
                                                 class="uil uil-plus">
                                            <span style="padding-left: 5px;">Delete</span>
                                        </button>
                                    </li>
                                    @elseif (isset($idBookingTable))
                                    <div style="width: 100%; display: flex; justify-content: center;">
                                        <li>
                                            <button data-food-id="{{$food->idFood}}" data-food-name="{{$food->nameFood}}" class="dish-add-btn btn-add-to-cart">
                                                <img src="{{ asset('assets/images/icon_cart_add_shopping_icon.png') }}"
                                                     class="uil uil-plus">
                                                <span style="padding-left: 5px;">Add</span>
                                            </button>
                                        </li>
                                    </div>
                                    @elseif($user && $user->role == 'CUSTOMER')
                                    <li>
                                        <a href="/customer/buynow/{{$food->idFood}}">
                                            <button class="dish-add-btn btn-buy-now">
                                                <img src="{{ asset('assets/images/icon_cart_ecommerce_fast_moving_icon.png') }}"
                                                     class="uil uil-plus">
                                                <span>Buy now</span>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <button data-food-id="{{$food->idFood}}" data-food-name="{{$food->nameFood}}" class="dish-add-btn btn-add-to-cart">
                                            <img src="{{ asset('assets/images/icon_cart_add_shopping_icon.png') }}"
                                                 class="uil uil-plus">
                                            <span style="padding-left: 5px;">Add</span>
                                        </button>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                        @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Menu end -->
    <!-- MODAL delete-->
    <div class="modal" tabindex="-1" id="confirm-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Purchase Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete sushi?</p>
                </div>
                <div class="modal-footer">
                    <a href="/menu" type="button" class="btn btn-secondary">Close</a>
                    <form action="/admin/deleteFood" method="post">
                        @csrf
                        <input id="idFood_input" name="idFood" value="" type="text" readonly style="display: none">
                        <button type="submit" id="confirm-delete-btn" class="btn btn-danger btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal notification begin-->
    <div id="modal_notification">
        <div class="modal_notification">
            <div style="width: 100%; display: flex; justify-content: end;">
                <button class="closeModal">
                    <img src="{{ asset('assets/images/icon_close_fill.png') }}" alt="">
                </button>
            </div>
            <div style="position: relative; margin-top: 20px;">
                <img src="{{ asset('assets/images/cart_shopping.png') }}" alt="" />
                <img class="cart_line" src="{{ asset('assets/images/cart_shopping_line.png') }}" alt="" />
                <img class="shop_bag animate__animated animate__fadeInDown"
                     src="{{ asset('assets/images/sushi_3.png') }}" alt="" />
            </div>
            <p class="content-notification" style="margin-top: 20px;" >
                The
                <span class="name-product-notification" style="font-weight: bold">sushi</span>
                has been
                <span class="text-add-to">
                added to cart
                </span>
            </p>
        </div>
    </div>
    <!-- Modal end -->
    <!-- main js -->
    <!-- swiper slider  -->
    <script src="{{ asset('assets/javascript/swiper-bundle.min.js') }}"></script>

    <!-- mixitup -- filter  -->
    <script src="{{ asset('assets/javascript/jquery.mixitup.min.js') }}"></script>
    <!-- fancy box  -->
    <script src="{{ asset('assets/javascript/jquery.fancybox.min.js') }}"></script>

    <!-- parallax  -->
    <script src="{{ asset('assets/javascript/parallax.min.js') }}"></script>

    <!-- gsap  -->
    <script src="{{ asset('assets/javascript/gsap.min.js') }}"></script>
    <!-- scroll trigger  -->
    <script src="{{ asset('assets/javascript/ScrollTrigger.min.js') }}"></script>
    <!-- scroll to plugin  -->
    <script src="{{ asset('assets/javascript/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('assets/javascript/L_menu.js') }}"></script>
@endsection
