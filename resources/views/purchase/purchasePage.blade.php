@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/L_purchaseCart.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @if (isset($idCart))
        <p style="display:none" class="idCart">{{$idCart}}</p>
    @elseif(isset($idBookingTable) && isset($isCheckin))
    <p style="display:none" class="idBookingTable">{{$idBookingTable}}</p>
    <p style="display:none" class="ischeckin">{{$isCheckin}}</p>
    @endif
    <div class="container-body" style="background-image: url({{ asset('assets/images/menu-bg.png') }});">
        <div class="cart-wrap">
            <div class="cart-details">
                <div class="title-cart">
                    <div class="title-cart-left">
                        <h1>My Cart</h1>
                    </div>
                    @if (isset($idBookingTable))
                        @if ($user->role == 'CUSTOMER' && $isCheckin == true)
                    <button disabled type="button" class="btn btn-success add-button" style="padding: 5px 15px; font-size:20px; font-weight: 600"><i class="fa-solid fa-plus" style="font-size: 15px;"></i> Add Food</button>
                        @else
                    <a href="/addBookingFood/{{$idBookingTable}}">
                        <button type="button" class="btn btn-success add-button" style="padding: 5px 15px; font-size:20px; font-weight: 600"><i class="fa-solid fa-plus" style="font-size: 15px;"></i> Add Food</button>
                    </a>
                        @endif
                    @endif
                    <div class="title-cart-right">
                        @if(!isset($food))
                        <h3 ><span class="num-item"></span> items</h3>
                        @endif
                    </div>
                </div>
                <!-- ----------------------------------- -->
                <!-- Ten sp -->
                <div class="list-product">
                    <!--  -->
                    @if (isset($listCartFood) && isset($food)  && isset($listBookingFood) )
                    <p style="margin-top: 20px;">Your cart is empty!</p>
                    @endif
                    @if (isset($listCartFood) )
                        @foreach($listCartFood as $cartFood)
                    <div class="content-cart" >
                        <p style="display:none" class="idCartFood">{{$cartFood->idCartFood}}</p>
                        <p style="display:none" class="idFood">{{$cartFood->idFood}}</p>
                        <div class="content-cart-left">
                            <div class="cart-img-name">
                                <img class="img-product"
                                     src="{{ asset('upload/menu/'.$cartFood->imgFood) }}"
                                     alt="Image Food">
                                <span class="name-food">{{$cartFood->nameFood}}</span>
                            </div>
                            <div class="content-cart-center-1">
                                <div class="add-sub-amount">
                                    <button class="sub-amount">
                                        <img src="{{ asset('assets/images/icon_minimize_fill.png') }}" alt="">
                                    </button>

                                    <input class="amount-product-cart" type="number" value="{{$cartFood->amountCF}}" min="1" oninput="validity.valid||(value='');" required onblur="if(this.value==''){this.value=1;}" title="Amount >= 1">

                                    <button class="plus-amount">
                                        <img src="{{ asset('assets/images/icon_add_fill_mainColor.png') }}" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Tang giam so luong -->


                        <div class="content-cart-right">
                            <!-- Gia tien -->
                            <div class="content-cart-center-2">
                                <span class="price-index-product" style="display: none;">{{$cartFood->priceCF}}</span>
                                <h3>
                                    <span class="sumPrice-index-product"></span>
                                    <span>$</span>
                                </h3>
                            </div>
                            <!-- Xoa san pham -->
                            <button data-href="/customer/deleteCF/{{$cartFood->idCartFood}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="remove">
                                <img src="{{ asset('assets/images/icon_delete_2_line_color.png') }}" alt="">
                            </button>
                        </div>
                        <p class="time-added">
                            <span>
                                Added in <span>{{$cartFood->datetimeCF->format('d/m/Y H:i')}}</span>
                            </span>
                            <span style="margin-left: 15px; color:red; font-size:14px" class="sold-out-text"></span>
                            <span style="margin-left: 15px; font-size:14px" class="remaining-text"></span>
                        </p>
                    </div>
                        @endforeach
                    @elseif(isset($food))
                    <div class="content-cart" >
                        <p style="display:none" class="idCartFood">0</p>
                        <p style="display:none" class="idFood">{{$food->idFood}}</p>
                        <div class="content-cart-left">
                            <div class="cart-img-name">
                                <img class="img-product"
                                     src="{{ asset('upload/menu/'.$food->imgFood) }}"
                                     alt="Image Food">
                                <span class="name-food">{{$food->nameFood}}</span>
                            </div>
                            <div class="content-cart-center-1">
                                <div class="add-sub-amount">
                                    <button class="sub-amount">
                                        <img src="{{ asset('assets/images/icon_minimize_fill.png') }}" alt="">
                                    </button>

                                    <input class="amount-product-cart" type="number" value="1" min="1" oninput="validity.valid||(value='');" required onblur="if(this.value==''){this.value=1;}" title="Amount >= 1">

                                    <button class="plus-amount">
                                        <img src="{{ asset('assets/images/icon_add_fill_mainColor.png') }}" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Tang giam so luong -->


                        <div class="content-cart-right">
                            <!-- Gia tien -->
                            <div class="content-cart-center-2">
                                <span class="price-index-product" style="display: none;">{{$food->priceFood}}</span>
                                <h3>
                                    <span class="sumPrice-index-product">{{$food->priceFood}}</span>
                                    <span>$</span>
                                </h3>
                            </div>
                        </div>
                        <p class="time-added">
                            <span style="margin-left: 15px; color:red; font-size:14px" class="sold-out-text"></span>
                            <span style="margin-left: 15px; font-size:14px" class="remaining-text"></span>
                        </p>
                    </div>
                    @elseif (isset($listBookingFood))
                        @foreach($listBookingFood as $bookingFood)
                    <div class="content-cart" >
                        <p style="display:none" class="idBookingFood">{{$bookingFood->idBookingFood}}</p>
                        <p style="display:none" class="idFood">{{$bookingFood->idFood}}</p>
                        <div class="content-cart-left">
                            <div class="cart-img-name">
                                <img class="img-product"
                                     src="{{ asset('upload/menu/'.$bookingFood->imgFood) }}"
                                     alt="Image Food">
                                <span class="name-food">{{$bookingFood->nameFood}}</span>
                            </div>
                            <div class="content-cart-center-1">
                                <div class="add-sub-amount">
                                    @if ($user->role == 'CUSTOMER' && $isCheckin == true)
                                    <button disabled class="sub-amount disable-btn-input">
                                        <img src="{{ asset('assets/images/icon_minimize_fill.png') }}" alt="" >
                                    </button>

                                    <input readonly class="amount-product-cart disable-btn-input" type="number" value="{{$bookingFood->amountBF}}" min="1" oninput="validity.valid||(value='');" required onblur="if(this.value==''){this.value=1;}" title="Amount >= 1">

                                    <button disabled class="plus-amount disable-btn-input">
                                        <img src="{{ asset('assets/images/icon_add_fill_mainColor.png') }}" alt="">
                                    </button>
                                    @else
                                    <button class="sub-amount">
                                        <img src="{{ asset('assets/images/icon_minimize_fill.png') }}" alt="">
                                    </button>

                                    <input class="amount-product-cart" type="number" value="{{$bookingFood->amountBF}}" min="1" oninput="validity.valid||(value='');" required onblur="if(this.value==''){this.value=1;}" title="Amount >= 1">

                                    <button class="plus-amount">
                                        <img src="{{ asset('assets/images/icon_add_fill_mainColor.png') }}" alt="">
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Tang giam so luong -->


                        <div class="content-cart-right">
                            <!-- Gia tien -->
                            <div class="content-cart-center-2">
                                <span class="price-index-product" style="display: none;">{{$bookingFood->priceBF}}</span>
                                <h3>
                                    <span class="sumPrice-index-product"></span>
                                    <span>$</span>
                                </h3>
                            </div>
                            <!-- Xoa san pham -->
                            @if ($isCheckin == false || ($user->role=='EMPLOYEE' && !isset($bill) ) || $user->role == 'ADMIN')
                            <button data-href="/deleteBF/{{$bookingFood->idBookingFood}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="remove">
                                <img src="{{ asset('assets/images/icon_delete_2_line_color.png') }}" alt="">
                            </button>
                            @endif
                        </div>

                        <p class="time-added">

                            <span style="margin-left: 15px; color:red; font-size:14px" class="sold-out-text"></span>
                            <span style="margin-left: 15px; font-size:14px" class="remaining-text"></span>
                        </p>
                    </div>
                            @endforeach
                    @endif
                </div>

            </div>
            <div class="pay-fees">
                <div class="title-pay">
                    <h1>Summary</h1>
                </div>
                <div class="details-pay">
                    <div class="amount-product">
                        <h4>
                            <span class="sumAmount"></span>
                            items
                        </h4>

                    </div>
                    <div class="price-product">
                        <h4 ><span class="sumMoney"></span> $</h4>

                    </div>
                </div>
                <div class="details-discount">
                    <div class="details-discount-header">
                        <h4 style="width: 130px; text-align: left;">Discount:</h4>
                    </div>
                    <div class="details-discount-body">
                        <div class="percent-discount">
                            <h4>
                                <span data-discount="{{$customer->discount}}" class="discount-user" style="margin-left: 30px;">{{$customer->discount}}</span>
                                <span>%</span>
                            </h4>
                        </div>
                        <div class="price-discount">
                            <h4 style="margin-right: 20px;">
                                <span>-</span>
                                <span class="discount-user-money"></span>
                                <span>$</span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="details-giftcode">
                    <div class="details-giftcode-header">
                        <h4 style="width: 130px; text-align: left;">Gift code:</h4>
                        <div class="details-discount-body">

                            <div class="percent-discount">
                                <h4>
                                    <span data-discountGiftCode="0" class="discount-giftCode" style="margin-left: 35px;">0</span>
                                    <span>%</span>
                                </h4>
                            </div>
                            <div class="price-discount">
                                <h4 style="margin-right: 20px;">
                                    <span>-</span>
                                    <span class="discount-giftCode-money"></span>
                                    <span>$</span>
                                </h4>
                            </div>

                        </div>
                    </div>
                    <div class="details-giftcode-body">
                        @if ($user->role == 'CUSTOMER' && isset($isCheckin))
                            @if ($isCheckin)
                        <input readonly class="input-giftcode" type="text">
                            @else
                        <input class="input-giftcode" type="text">
                            @endif
                        @else
                            <input class="input-giftcode" type="text">
                        @endif
                    </div>
                    <div class="details-giftcode-footer">
                        <h6 class="giftcode-text-notification">Enter your code</h6>
                    </div>
                </div>
                <div class="purchase-product">
                    <div class="price-closing">
                        <div class="price-closing-left">
                            <h3>TOTAL PRICE</h3>
                        </div>
                        <div class="price-closing-right">
                            <h3 style="color: red;font-size: 40px;">
                                <span class="total-price" >0</span>
                                <span>$</span>
                            </h3>
                        </div>
                    </div>
                    <div class="btn-purchase">
                        @if ($user->role == 'CUSTOMER' && (isset($listCartFood) || isset($food) ))
                            <button id="button-purchase">
                                <h2>Purchase</h2>
                            </button>
                        @elseif(isset($bill))
                            @if ($user->role != 'ADMIN')
                        <button disabled class="disable-btn-input">
                            <h2>Purchase</h2>
                        </button>
                            @else
                        <button id="button-purchase" data-id-bill="{{$bill->idBill}}">
                            <h2>Update</h2>
                        </button>
                            @endif
                        @elseif(isset($listBookingFood) && $user->role == 'CUSTOMER')
                            <button disabled class="disable-btn-input">
                                <h2>Purchase</h2>
                            </button>
                        @elseif(isset($listBookingFood) && $user->role != 'CUSTOMER')
                            <button id="button-purchase">
                                <h2>Purchase</h2>
                            </button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <!-- MODAL delete-->
        <div class="modal" tabindex="-1" id="confirm-delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Purchase Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to remove sushi from the cart?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="" onClick="location.reload()" type="button" class="btn btn-secondary">Close</a>
                        <a class="btn btn-danger btn-delete">Remove</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL purchase-->
        <div class="modal" tabindex="-1" id="confirm-purchase">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Purchase Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body purchase-modal-body">
                        <p>The <span><b class="nameFood-soldOut-last">sushi</b></span> is <span style="color:red">sold out</span> now.</p>
                        <span class="notice-delete-text" style="display: none">If you continue to purchase, the food is out of stock will be deleted!</span>
                        <p>Do you want to continue purchase?</p>
                    </div>
                    <p style="margin-left:16px">This dialog will be close in <span class="countdown" style="color:red">3</span>s</p>
                    <div class="modal-footer">
                        <a onClick="location.reload()" type="button" class="btn btn-secondary btn-close-purchase">Close</a>
                        <a class="btn btn-danger btn-delete btn-continue-purchase">Continue</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function()
            {
                $('#confirm-delete').on('show.bs.modal', function(e){
                    $(this).find('.btn-delete').attr('href', $(e.relatedTarget).data('href'));
                });
            });
        </script>
        <!-- Loading -->
        <div id="loading">
            <div class="ic-Spin-cycle--classic">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="156 -189 512 512" enable-background="new 156 -189 512 512" xml:space="preserve">
                    <path d="M636 99h-64c-17.7 0-32-14.3-32-32s14.3-32 32-32h64c17.7 0 32 14.3 32 32S653.7 99 636 99z"/>
                    <path d="M547.8-23.5C535.2-11 515-11 502.5-23.5s-12.5-32.8 0-45.2l45.2-45.2c12.5-12.5 32.8-12.5 45.2 0s12.5 32.8 0 45.2L547.8-23.5z"/>
                    <path d="M412-61c-17.7 0-32-14.3-32-32v-64c0-17.7 14.3-32 32-32s32 14.3 32 32v64C444-75.3 429.7-61 412-61z"/>
                    <path d="M276.2-23.5L231-68.8c-12.5-12.5-12.5-32.8 0-45.2s32.8-12.5 45.2 0l45.2 45.2c12.5 12.5 12.5 32.8 0 45.2S288.8-11 276.2-23.5z"/>
                    <path d="M284 67c0 17.7-14.3 32-32 32h-64c-17.7 0-32-14.3-32-32s14.3-32 32-32h64C269.7 35 284 49.3 284 67z"/>
                    <path d="M276.2 248c-12.5 12.5-32.8 12.5-45.2 0 -12.5-12.5-12.5-32.8 0-45.2l45.2-45.2c12.5-12.5 32.8-12.5 45.2 0s12.5 32.8 0 45.2L276.2 248z"/>
                    <path d="M412 323c-17.7 0-32-14.3-32-32v-64c0-17.7 14.3-32 32-32s32 14.3 32 32v64C444 308.7 429.7 323 412 323z"/>
                    <path d="M547.8 157.5l45.2 45.2c12.5 12.5 12.5 32.8 0 45.2 -12.5 12.5-32.8 12.5-45.2 0l-45.2-45.2c-12.5-12.5-12.5-32.8 0-45.2S535.2 145 547.8 157.5z"/>
                </svg>
            </div>
        </div>


    </div>
    <!-- Menu end -->
    <!-- main js -->
    <script src="{{ asset('assets/javascript/L_purchaseCart.js') }}"></script>
@endsection
