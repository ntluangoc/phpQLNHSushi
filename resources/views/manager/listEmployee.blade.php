@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/TH_QL_quanlyNV.css') }}">

@endsection
@section('content')
    <section style="background-image: url({{ asset('assets/images/menu-bg.png') }});" class="our-menu section bg-light repeat-img"
             id="menu">
        <div class="sec-wp">
            <div class="container">
                <div class="menu-tab-wp" style="position: relative;">
                    <div class="row">
                        <div class="col-lg-12 m-auto">
                            <div class="menu-tab text-center">
                                <!-- Add Human -->
                                <a href="/admin/addEmployee">
                                    <ul class="filters add-human">
                                        <i class="fa-solid fa-circle-plus" style="color: #ff8243; font-weight: 900;font-size: 44px;padding-right: 5px;"></i>
                                        Add employee
                                        </li>
                                    </ul>
                                </a>

                                <!---->
                                <ul class="filters" style="position: absolute; left: 50%; transform: translateX(-50%);">
                                    <div class="filter-active"></div>
                                    <li class="filter" data-filter=".all, .Employee, .Chef">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/QL_all.png') }}" alt="">
                                        All
                                    </li>
                                    <li class="filter" data-filter=".Employee">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/QL_employee.png') }}" alt="">
                                        Employee
                                    </li>
                                    <li class="filter" data-filter=".Chef">
                                        <img style="width: 60px; height: 40px;" src="{{ asset('assets/images/QL_chef.png') }}" alt="">
                                        Chef
                                    </li>
                                </ul>
                                <!-- Search Human -->
                                <ul class="filters search-button">
                                    <!-- Hiển thị kết quả tìm kiếm -->
                                    <form method="post" action="">
                                        @csrf
                                        @if (isset($nameSearch))
                                        <input type="text" class="search-input" name="nameSearch" value="{{$nameSearch}}" placeholder="Search by name ...">
                                        @else
                                            <input type="text" class="search-input" name="nameSearch" value="" placeholder="Search by name ...">
                                        @endif
                                            <button type="submit" class="search-icon">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-list-row">
                    <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                        @foreach($listEmployee as $employee)
                        <!-- 1 -->
                        <div class="col-lg-4 col-sm-6 dish-box-wp {{$employee->position}}" data-cat="{{$employee->position}}">
                        <div class="dish-box text-center">
                            <div class="dist-img">
                                @if (!$employee->avatar)
                                <img src="{{ asset('upload/user/employee.png') }}" alt="">
                                @else
                                <img src="{{ asset('upload/user/'.$employee->avatar) }}" alt="">
                                @endif
                            </div>
                            <div class="human-title">
                                <h3 class="h3-title">{{$employee->nameUser}}</h3>
                            </div>

                            <div class="human-list">
                                <table class="human-info">
                                    <tr>
                                        <th>Birthday:</th>
                                        <td>{{$employee->birthday}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td>{{$employee->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td>{{$employee->address}}</td>
                                    </tr>
                                    <tr>
                                        <th>Position:</th>
                                        <td>{{$employee->position}}</td>
                                    </tr>
                                    <tr>
                                        <th>Salary:</th>
                                        <td>{{$employee->salary}}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="dist-bottom-row">
                                <ul>
                                    <a href="/admin/editEmployee/{{$employee->idEmployee}}">
                                        <li >
                                            <button class="dish-add-btn btn-buy-now">
                                                <i class="fa-regular fa-pen-to-square fa-lg" style="color: #fff;"></i>
                                                <span>Edit</span>
                                            </button>
                                        </li>
                                    </a>
                                    <li>
                                        <button data-href="/admin/deleteEmployee/{{$employee->idUser}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="dish-add-btn btn-add-to-cart">
                                            <i class="fa-solid fa-user-minus fa-lg" style="color: #fff;"></i>
                                            <span style="padding-left: 5px;">Delete</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- -->
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
                    <h5 class="modal-title">Delete Employee Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete employee?</p>
                </div>
                <div class="modal-footer">
                    <a href="/admin/listEmployee" type="button" class="btn btn-secondary">Close</a>
                    <a class="btn btn-danger btn-delete">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- mixitup -- filter  -->
    <script src="{{ asset('assets/javascript/jquery.mixitup.min.js') }}"></script>
    <!-- gsap  -->
    <script src="{{ asset('assets/javascript/gsap.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/javascript/TH_QL_quanlyNV.js') }}"></script>
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
