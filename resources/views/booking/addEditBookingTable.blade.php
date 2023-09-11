@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/T_SetATable.css') }}">
@endsection
@section('content')
    @if (isset($bookingTable))
    <p id="isUpdate" style="display:none">1</p>
    @endif
    <p id="role" style="display:none">{{$user->role}}</p>
    <div class="div_container">
        @if (isset($bookingTable))
        <form action="/posteditBookingTable/{{$bookingTable->idBookingTable}}" method="post">
            @csrf
            <div class="container_0">
                <h1 class="header_0">Update a booking table</h1>
                <div class="header__one">
                    @if ($bookingTable->isCheckin && $user->role != 'ADMIN')
                    <div class="header_1">
                        <p class="header_title">Type:</p>
                        <select disabled class="ais-SortBy-select" id="typeTable" name="typeTable" value="{{$bookingTable->typeTable}}">
                            <option class="ais-SortBy-option" value="2">2 people</option>
                            <option class="ais-SortBy-option" value="4">4 people</option>
                            <option class="ais-SortBy-option" value="6">6 people</option>
                            <option class="ais-SortBy-option" value="10">10 people</option>
                        </select>
                    </div>
                    <div class="header_1">
                        <p class="header_title">Amount:</p>
                        <input readonly type="number" min="1" class="header_2" id="amountBT" name="amountBT" value="{{$bookingTable->amountBT}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Date:</p>
                        <input readonly type="date" class="header_2" id="dateBT" name="dateBT" value="{{$bookingTable->dateBT->format('Y-m-d')}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Time:</p>
                        <p style="display:none" id="timeBT">{{$bookingTable->timeBT}}</p>
                        <input readonly id = "timeBT2" type="time" class="header_2" class="input_timeBT" name="timeBT" value="{{$bookingTable->timeBT}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Note:</p>
                        <input readonly type="text" class="header_3" id="noteBT" name="noteBT" value="{{$bookingTable->noteBT}}">
                    </div>
                    @else
                    <div class="header_1">
                        <p class="header_title">Type:</p>
                        <select class="ais-SortBy-select" id="typeTable" name="typeTable" value="{{$bookingTable->typeTable}}">
                            <option class="ais-SortBy-option" value="2">2 people</option>
                            <option class="ais-SortBy-option" value="4">4 people</option>
                            <option class="ais-SortBy-option" value="6">6 people</option>
                            <option class="ais-SortBy-option" value="10">10 people</option>
                        </select>
                    </div>
                    <div class="header_1">
                        <p class="header_title">Amount:</p>
                        <input type="number" min="1" class="header_2" id="amountBT" name="amountBT" value="{{$bookingTable->amountBT}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Date:</p>
                        <input type="date" class="header_2" id="dateBT" name="dateBT" value="{{$bookingTable->dateBT->format('Y-m-d')}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Time:</p>
                        <p style="display:none" id="timeBT"><%=timeBT%></p>
                        <input id = "timeBT2" type="time" class="header_2" class="input_timeBT" name="timeBT" value="{{$bookingTable->timeBT}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Note:</p>
                        <input type="text" class="header_3" id="noteBT" name="noteBT" value="{{$bookingTable->noteBT}}">
                    </div>
                    @endif
                </div>
                <p class="p_error" style="padding: 5px 10px; height: 24px; text-align: center; color: red;width: 350px; white-space: break-spaces;margin: 0 auto;"></p>

                <div class="controls">
                    <div class="controls_1">
                        @if ($bookingTable->isCheckin && $user->role != 'ADMIN')
                        <a style="text-decoration: none" onclick="location.href='{{ route('cancel') }}'" class="btn btn-primary key">
                        Cancel
                        </a>
                        @else
                        <button id="btn-submit" type="submit" class="btn btn-primary key btn-setTable">Set</button>
                        @endif
                            @if ($user->role == 'ADMIN')
                        <button type="button" data-href="/admin/deleteBookingTable/{{$bookingTable->idBookingTable}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="btn btn-primary delete-btn">Delete</button>
                            @elseif (!$bookingTable->isCheckin && $user->role == 'EMPLOYEE')
                        <button type="button" data-href="/admin/deleteBookingTable/{{$bookingTable->idBookingTable}}" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="btn btn-primary delete-btn">Delete</button>
                            @endif
                    </div>
                </div>
            </div>
        </form>
        @else
            <form action="/customer/addBookingTable" method="post">
                @csrf
                <div class="container_0">
                    <h1 class="header_0">Set a booking table</h1>
                    <div class="header__one">
                            <div class="header_1">
                                <p class="header_title">Type:</p>
                                <select class="ais-SortBy-select" id="typeTable" name="typeTable" value="">
                                    <option class="ais-SortBy-option" value="2">2 people</option>
                                    <option class="ais-SortBy-option" value="4">4 people</option>
                                    <option class="ais-SortBy-option" value="6">6 people</option>
                                    <option class="ais-SortBy-option" value="10">10 people</option>
                                </select>
                            </div>
                            <div class="header_1">
                                <p class="header_title">Amount:</p>
                                <input type="number" min="1" class="header_2" id="amountBT" name="amountBT" value="">
                            </div>
                            <div class="header_1">
                                <p class="header_title">Date:</p>
                                <input type="date" class="header_2" id="dateBT" name="dateBT" value="">
                            </div>
                            <div class="header_1">
                                <p class="header_title">Time:</p>
                                <p style="display:none" id="timeBT"></p>
                                <input id = "timeBT2" type="time" class="header_2" class="input_timeBT" name="timeBT" value="">
                            </div>
                            <div class="header_1">
                                <p class="header_title">Note:</p>
                                <input type="text" class="header_3" id="noteBT" name="noteBT" value="">
                            </div>
                    </div>
                    <p class="p_error" style="padding: 5px 10px; height: 24px; text-align: center; color: red;width: 350px; white-space: break-spaces;margin: 0 auto;"></p>

                    <div class="controls">
                        <div class="controls_1">
                            <button id="btn-submit" type="submit" class="btn btn-primary key btn-setTable">Set</button>
                            <a href="" style="text-decoration: none">
                                <button type="button" onclick="location.href='{{ route('cancel') }}'" class="btn btn-primary key">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
    <!-- MODAL delete-->
    <div class="modal" tabindex="-1" id="confirm-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this booking table?</p>
                </div>
                <div class="modal-footer">
                    <a href="" type="button" class="btn btn-secondary">Close</a>
                    <a class="btn btn-danger btn-delete">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/javascript/TH_SetATable.js') }}"></script>
    <!-- Modal js  -->
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
