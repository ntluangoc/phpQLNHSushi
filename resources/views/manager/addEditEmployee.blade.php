@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/T_AddEmployee.css') }}">

@endsection
@section('content')
    <div class="div_container">
        <div class="human-list dish-box">
            @if (isset($employee))
            <form id="uploadImg-form" action="" accept-charset="utf-8" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center box gr-img">
                    <div class="dist-img">
                        <div style="position:relative">
                            @if (!$employee->avatar)
                            <img src="{{ asset('upload/user/employee.png') }}" alt="avatar" id="img-preview">
                            @else
                            <img src="{{ asset('upload/user/'.$employee->avatar) }}" alt="avatar" id="img-preview">
                            @endif
                            <input type="file" accept=".jpg, .jpeg, .png" name="avatar" id="img-upload" style="display:none">
                            <div class="camera-above">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <input id="img-input" type="text" value="{{$employee->avatar}}" name="oldFileName" style="display: none;">
                <input type="number" name="idUser" value="{{$employee->idUser}}" style="display: none">
                <div class="header__one">
                    <div class="header_1">
                        <p class="header_title">Name:</p>
                        <input type="text" class="header_2" id="nameUser" name="nameUser" value="{{$employee->nameUser}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Birthday:</p>
                        <input type="date" class="header_2" id="birthday" name="birthday" value="{{$employee->birthday}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Phone:</p>
                        <input type="number" class="header_2" id="phone" name="phone" value="{{$employee->phone}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Address:</p>
                        <input type="text" class="header_2" id="address" name="address" value="{{$employee->address}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Email:</p>
                        <input type="text" class="header_2" id="email" name="email" value="{{$employee->email}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Salary:</p>
                        <input type="text" class="header_2" id="salary" name="salary" value="{{$employee->salary}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Position:</p>
                        <select class="ais-SortBy-select" id="position" name="position" >
                            <option class="ais-SortBy-option" value="Employee" @if($employee->position === 'Employee') selected @endif>Employee</option>
                            <option class="ais-SortBy-option" value="Chef" @if($employee->position === 'Chef') selected @endif>Chef</option>
                        </select>
                    </div>
                </div>
                <p class="p_error" style="padding: 5px 10px; height: 24px; text-align: center; color: red;width: 100%; white-space: break-spaces;"></p>
                <div class="controls">
                    <div class="controls_1">
                        <button id="btn-submit" type="submit" class="btn btn-primary key" style="padding: 0px 46px;">Update</button>
                        <a href="/admin/listEmployee" type="button" class="btn btn-primary key">Cancel</a>
                    </div>
                </div>
            </form>
            @else
                <form id="uploadImg-form" action="" accept-charset="utf-8" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center box gr-img">
                        <div class="dist-img">
                            <div style="position:relative">
                                    <img src="{{ asset('upload/user/employee.png') }}" alt="avatar" id="img-preview">
                                <input type="file" accept=".jpg, .jpeg, .png" name="avatar" id="img-upload" style="display:none">
                                <div class="camera-above">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="header__one">
                        <div class="header_1">
                            <p class="header_title">Name:</p>
                            <input type="text" class="header_2" id="nameUser" name="nameUser" >
                        </div>
                        <div class="header_1">
                            <p class="header_title">Birthday:</p>
                            <input type="date" class="header_2" id="birthday" name="birthday">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Phone:</p>
                            <input type="number" class="header_2" id="phone" name="phone" >
                        </div>
                        <div class="header_1">
                            <p class="header_title">Address:</p>
                            <input type="text" class="header_2" id="address" name="address" >
                        </div>
                        <div class="header_1">
                            <p class="header_title">Email:</p>
                            <input type="text" class="header_2" id="email" name="email">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Salary:</p>
                            <input type="text" class="header_2" id="salary" name="salary">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Position:</p>
                            <select class="ais-SortBy-select" id="position" name="position">
                                <option class="ais-SortBy-option" value="Employee">Employee</option>
                                <option class="ais-SortBy-option" value="Chef">Chef</option>
                            </select>
                        </div>
                    </div>
                    <p class="p_error" style="padding: 5px 10px; height: 24px; text-align: center; color: red;width: 100%; white-space: break-spaces;"></p>
                    <div class="controls">
                        <div class="controls_1">
                            <button id="btn-submit" type="submit" class="btn btn-primary key" style="padding: 0px 46px;">Add</button>
                            <a href="/admin/listEmployee" type="button" class="btn btn-primary key">Cancel</a>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <!-- header js -->
    <script src="{{ asset('assets/javascript/T_AddEmployee.js') }}"></script>
    <script>
        const imgUpload = document.getElementById('img-upload');
        const imgPreview = document.getElementById('img-preview');
        const btnCamera = document.querySelector('.camera-above');
        btnCamera.addEventListener('click', function() {
            imgUpload.click();
        });

        imgUpload.addEventListener('change', function() {
            const file = imgUpload.files[0];
            const reader = new FileReader();
            var maxSize = 5 * 1024 * 1024; // Giới hạn dung lượng tối đa là 5MB
            if (file.size > maxSize) {
                alert('Dung lượng file vượt quá giới hạn cho phép.');
                imgUpload.value = ''; // Xóa giá trị file đã chọn
            } else{
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
