@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/T_EditUser.css') }}">
@endsection
@section('content')
    <div class="div_container">
        <div class="human-list dish-box">
            <form action="/postedit/{{$user->idUser}}" id="uploadImg-form"  accept-charset="utf-8" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center box gr-img">
                    <div class="dist-img">
                        <div style="position:relative">
                            @if ($user->avatar == null)
                            <img src="{{ asset('upload/user/user.png') }}" alt="avatar" id="img-preview">
                            @else
                            <img src="{{ asset('upload/user/'.$user->avatar) }}" alt="avatar" id="img-preview">
                            @endif
                            <input type="file" accept=".jpg, .jpeg, .png" name="avatar" id="img-upload" style="display:none">
                            <div class="camera-above">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                        </div>
                    </div>
                    <script>

                    </script>
                </div>
                <input id="img-input" type="text" value="{{$user->avatar}}" name="oldFileName" style="display: none;">
                <input type="number" name="idUser" value="{{$user->idUser}}" style="display: none">
                <div class="container_0">
                    <div class="header__one">
                        <div class="header_1">
                            <p class="header_title">Name:</p>
                            <input type="text" class="header_2" id="nameUser" name="nameUser" value="{{$user->nameUser}}">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Birthday:</p>
                            <input type="date" class="header_2" id="birthday" name="birthday" value="{{$user->birthday->format('Y-m-d')}}">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Phone:</p>
                            <input type="number" class="header_2" id="phone" name="phone" value="{{$user->phone}}">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Address:</p>
                            <input type="text" class="header_2" id="address" name="address" value="{{$user->address}}">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Email:</p>
                            <input type="text" class="header_2" id="email" name="email" value="{{$user->email}}">
                        </div>
                    </div>
                    <p class="p_error" style="padding: 5px 10px; height: 24px; text-align: center; color: red;width: 100%; white-space: break-spaces;"></p>
                    <div class="controls">
                        <div class="controls_1">
                            <button id="btn-submit" type="submit" class="btn btn-primary key">Set</button>
                            <a onclick="location.href='{{ route('cancel') }}'" type="button" class="btn btn-primary key">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
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
        //
        const btn_submit = document.getElementById('btn-submit');
        let title_error = document.querySelector('.p_error');
        // kiểm tra tên
        function checkName() {
            let input_name = document.getElementById('nameUser').value;
            const regex = /^[\p{L}\s']{2,50}$/u;
            if (regex.test(input_name)) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'You must enter a valid name!';
                btn_submit.disabled = true;
            }
        }
        // kiểm tra số điện thoại
        function checkPhone() {
            let input_phone = document.getElementById('phone').value;
            const regex = /^(?:\+84|0)(?:\d){9,10}$/;
            if (regex.test(input_phone) && input_phone > 0) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'You must enter a valid phone!';
                btn_submit.disabled = true;
            }
        }
        // kiểm tra địa chỉ
        function checkAddress() {
            let input_address = document.getElementById('address').value;
            const regex = /^[\p{L}\s'\d]{2,50}$/u;
            if (regex.test(input_address)) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'You must enter a valid address!';
                btn_submit.disabled = true;
            }
        }
        // kiểm tra email
        function checkEmail() {
            let input_email = document.getElementById('email').value;
            const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,50}$/;
            if (regex.test(input_email)) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'You must enter the correct email format!';
                btn_submit.disabled = true;
            }
        }
        // kiểm tra password
        function checkPassword() {
            let input_password = document.getElementById('password').value;
            const regex = /^[^\s]+$/;
            if (regex.test(input_password)) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'Password must not contain spaces';
                btn_submit.disabled = true;
            }
        }

        // thực thi function
        document.getElementById('nameUser').addEventListener('change', checkName);
        document.getElementById('phone').addEventListener('change', checkPhone);
        document.getElementById('email').addEventListener('change', checkEmail);
        document.getElementById('password').addEventListener('change', checkPassword);
    </script>
@endsection
