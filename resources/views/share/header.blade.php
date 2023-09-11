@php
    $user = app(\App\Http\Controllers\LoginController::class)->getInfoUser();
@endphp

<!-- start of header  -->
<body>
<header class="site-header header-white">
    <div class="container header-height">
        <div class="row">
            <div class="col-lg-2">
                <div class="header-logo">
                    <a data-href="index.html">
                        <img src="{{ asset('assets/images/logo.png') }}" width="160" height="45" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="main-navigation">
                    <button class="menu-toggle"><span></span><span></span></button>
                    <nav class="header-menu">
                        <ul class="menu food-nav-menu">
                            <li><a href="/">Home</a></li>
                            @if($user && $user->role == 'CUSTOMER')
                            <li><a href="/customer/booking">Booking</a></li>
                            @elseif ($user && $user->role=='EMPLOYEE')
                                <li><a href="/employee/booking">Booking</a></li>
                            @else
                                <li><a href="/admin/booking">Booking</a></li>
                            @endif
                            <li><a href="/menu">Menu</a></li>

                            <li>
                                <div class="btn-group btn_manager">
                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false" style="background-image: none;">
                                        Manager
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if ($user && $user->role == 'ADMIN')
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/admin/listEmployee"
                                                                               style="width: 100%; border-radius: 0;">Employees</a></li>
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/admin/listCustomer"
                                                                               style="width: 100%; border-radius: 0;">Customers</a></li>
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/admin/restaurant"
                                                                               style="width: 100%; border-radius: 0;">Restaurant</a></li>
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/admin/listTable"
                                                                               style="width: 100%; border-radius: 0;">Table</a></li>
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/listBill"
                                                                               style="width: 100%; border-radius: 0;">Bill</a></li>
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/admin/giftcode"
                                                                               style="width: 100%; border-radius: 0;">GiftCode</a></li>
                                        @elseif ($user && $user->role == 'EMPLOYEE')
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/employee/listCustomer"
                                                                               style="width: 100%; border-radius: 0;">Customers</a></li>
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/employee/listTable"
                                                                               style="width: 100%; border-radius: 0;">Table</a></li>
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/listBill"
                                                                               style="width: 100%; border-radius: 0;">Bill</a></li>
                                        @elseif ($user && $user->role = 'CUSTOMER')
                                        <li style="width: 100%; margin: 0;"><a class="dropdown-item" href="/listBill"
                                                                               style="width: 100%; border-radius: 0;">Cart Bill</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </nav>
                    <div class="header-right">
                        @if ($user && $user->role == 'CUSTOMER')
                        <div class="header-cart">
                            <a href="/customer/cart" class="header-btn icon-white" style="margin: 0;">
                                <img src="{{ asset('assets/images/icon_shopping_cart_2_line.png') }}">
                                <span class="cart-number"></span>
                            </a>
                            <div id="modal-cart">
                                <div class="triangle"></div>
                                <div class="list-food-cart" data-image-url="{{ asset('assets/images/cart_shopping.png') }}">
{{--                                    <p>Recently Added Products</p>--}}
{{--                                    <div class="index_product">--}}
{{--                                        <img class="cart_img" src="" alt="">--}}
{{--                                        <div class="group_name_price">--}}
{{--                                            <span class="cart_name">Nishin with Mayonnase Gunkan</span>--}}
{{--                                            <span class="cart_price">4.49$</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                                <div class="btn_show_cart">
                                    <a href="/customer/cart">View My Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="header-info">
                            <a data-href="" class="header-btn header-info icon-white" style="margin: 0;">
                                <img src="{{ asset('assets/images/icon_user_3_line.png') }}">
                            </a>
                            <div id="modal-info">
                                <div class="triangle"></div>
                                @if($user)
                                <div class="info">
                                    @if ($user->avatar == null)
                                        <img src="{{ asset('upload/user/user.png') }}" alt="">
                                    @else
                                        <img src="{{ asset('upload/user/'.$user->avatar) }}" alt="">
                                    @endif
                                    <div class="group_name_email">

                                        <p class="name_User">{{$user->nameUser}}</p>
                                        <span class="email_User">{{$user->email}}</span>
                                    </div>
                                </div>
                                <a href="/information/{{$user->idUser}}">
                                <img src="{{ asset('assets/images/icon_information_line.png') }}" alt="">
                                My Information</a>
                                <a href="/logout">
                                    <img src="{{ asset('assets/images/icon_logout.png') }}" alt="">
                                    Logout</a>

                                @else
                                <div class="btn_show_cart">
                                    <a href="/loginPage">Please login</a>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header ends  -->
@include('share.error')
<!-- header js -->

<script src="{{ asset('assets/javascript/L_header.js') }}"></script>
</body>
