@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/TH_listTable.css') }}">
@endsection
@section('content')
    <section style="background-image: url({{ asset('assets/images/menu-bg.png') }}); overflow-x: hidden;" class="our-menu section bg-light repeat-img"
             id="menu">
        <div class="sec-wp">
            <div class="container" style="max-width: 100vw !important;">
                <div class="menu-tab-wp">
                    <div class="row">
                        <div class="col-lg-12 m-auto">
                            <div class="menu-tab text-center">
                                <!-- Main  -->
                                <ul class="filters" style="position: absolute; left: 50%; transform: translateX(-50%);">
                                    <div class="filter-active"></div>
                                    <li class="filter" data-filter=".all, .employee, .chef">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/dinnerTable.png') }}" alt="">
                                        List Table
                                    </li>
                                </ul>
                                <!-- Add Human -->
                                @if ($user->role == 'ADMIN')
                                <a href="/admin/addTable">
                                    <ul class="filters add-human" style="padding: 10px 20px;">
                                        <i class="fa-solid fa-circle-plus" style="color: #ff8243; font-weight: 900;font-size: 44px;padding-right: 5px;"></i>
                                        Add table
                                        </li>
                                    </ul>
                                </a>
                                @endif
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-list-row">
                    <div class="row g-xxl-5 bydefault_show width4" id="menu-dish">
                        <!-- 1 -->
                        @foreach($listTable as $table)
                        <div class="col-lg-4 col-sm-6 dish-box-wp chef width25">
                            <div class="dish-box text-center">
                                <div class="dist-img">
                                    <img src="{{ asset('upload/table/'.$table->imgTable) }}" alt="">
                                </div>
                                <div class="human-list">
                                    <table class="human-info">
                                        <tr>
                                            <th>Type:</th>
                                            <td>{{$table->typeTable}} People</td>
                                        </tr>
                                        <tr>
                                            <th>Amount:</th>
                                            <td>{{$table->amountTable}}</td>
                                        </tr>
                                    </table>
                                </div>
                                @if ($user->role == 'ADMIN')
                                <div class="dist-bottom-row">
                                    <ul>
                                        <li >
                                            <a href="/admin/editTable/{{$table->idTable}}">
                                                <button class="dish-add-btn btn-buy-now">
                                                    <i class="fa-regular fa-pen-to-square fa-lg" style="color: #fff;"></i>
                                                    <span>Edit</span>
                                                </button>
                                            </a>
                                        </li>
                                        <li>
                                            <button data-href="/admin/deleteTable/{{$table->idTable}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="dish-add-btn btn-add-to-cart">
                                                <i class="fa-solid fa-user-minus fa-lg" style="color: #fff;"></i>
                                                <span style="padding-left: 5px;">Delete</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <!--  -->
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
                    <h5 class="modal-title">Delete Table Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete table?</p>
                </div>
                <div class="modal-footer">
                    <a href="/admin/listTable" type="button" class="btn btn-secondary">Close</a>
                    <a class="btn btn-danger btn-delete">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- gsap  -->
    <script src="{{ asset('assets/javascript/gsap.min.js') }}"></script>

    <script>
        $(function () {
            $('#confirm-delete').on('show.bs.modal', function (e) {
                $(this)
                    .find('.btn-delete')
                    .attr('href', $(e.relatedTarget).data('href'));
            });
        });
    </script>

@endsection
