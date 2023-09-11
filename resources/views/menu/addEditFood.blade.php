@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/T_AddFood.css') }}">
@endsection
@section('content')
    <div class="div_container">

        <div class="human-list dish-box">
            @if (isset($food))
            <form action="/admin/editFood/save/{{$food->idFood}}" id="uploadImg-form"  accept-charset="utf-8" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center box gr-img">
                    <div class="dist-img">
                        <div style="position:relative">
                            @if (!isset($food) || !$food->imgFood)
                                <img src="{{ asset('upload/menu/demo.jpg') }}" alt="imgFood" id="img-preview">
                                @else
                                <img src="{{ asset('upload/menu/'.$food->imgFood) }}" alt="imgFood" id="img-preview">
                                @endif
                                <input type="file" accept=".jpg, .jpeg, .png" name="imgFood" id="img-upload" style="display:none">
                                <div class="camera-above">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                        </div>
                    </div>
                    <script>

                    </script>
                </div>
                <input id="img-input" type="text" value="{{$food->imgFood}}" name="oldFileName" style="display: none;">
                <div class="header__one">
                    <div class="header_1">
                        <p class="header_title">Name:</p>
                        <input type="text" class="header_2" id="name" name="nameFood" value="{{$food->nameFood}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Type:</p>
                        <select class="ais-SortBy-select header_2" id="typer" name="typeFood" value="{{$food->typeFood}}">
                            <option class="ais-SortBy-option" value="Starter">Starter</option>
                            <option class="ais-SortBy-option" value="MainCourse">Main Course</option>
                            <option class="ais-SortBy-option" value="Dessert">Dessert</option>
                        </select>
                    </div>
                    <div class="header_1">
                        <p class="header_title">For person:</p>
                        <input type="number" min="1" class="header_2" id="forPerson" name="forPerson" value="{{$food->forPerson}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Price:</p>
                        <input type="text" class="header_2" id="priceFood" name="priceFood" value="{{$food->priceFood}}">
                    </div>
                    <div class="header_1">
                        <p class="header_title">Amount:</p>
                        <input type="number"  min="1" class="header_2" id="amount" name="amountFood" value="{{$food->amountFood}}">
                    </div>
                </div>
                <p class="p_error" style="padding: 5px 10px; height: 24px; text-align: center; color: red;width: 100%; white-space: break-spaces;"></p>
                <div class="controls">
                    <div class="controls_1">
                        <button id="btn-submit" type="submit" class="btn btn-primary key" style="padding: 0px 46px;">Update</button>
                        <a href="/menu" type="button" class="btn btn-primary">Cancel</a>
                    </div>
                </div>
            </form>
            @else
                <form action="/admin/addFood/save" id="uploadImg-form"  accept-charset="utf-8" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center box gr-img">
                            <div class="dist-img">
                                <div style="position:relative">
                                    <img src="{{ asset('upload/menu/demo.jpg') }}" alt="imgFood" id="img-preview">
                                    <input type="file" accept=".jpg, .jpeg, .png" name="imgFood" id="img-upload" style="display:none">
                                    <div class="camera-above">
                                        <i class="fa-solid fa-camera"></i>
                                    </div>
                                </div>
                            </div>
                            <script>

                            </script>
                        </div>
                    <div class="header__one">
                        <div class="header_1">
                            <p class="header_title">Name:</p>
                            <input type="text" class="header_2" id="name" name="nameFood" value="">
                        </div>
                        <div class="header_1">
                            <p class="header_title">Type:</p>
                            <select class="ais-SortBy-select header_2" id="typer" name="typeFood" value="">
                                <option class="ais-SortBy-option" value="Starter">Starter</option>
                                <option class="ais-SortBy-option" value="Main Course">Main Course</option>
                                <option class="ais-SortBy-option" value="Dessert">Dessert</option>
                            </select>
                        </div>
                        <div class="header_1">
                            <p class="header_title">For person:</p>
                            <input type="number" min="1" class="header_2" id="forPerson" name="forPerson" >
                        </div>
                        <div class="header_1">
                            <p class="header_title">Price:</p>
                            <input type="text" class="header_2" id="priceFood" name="priceFood" >
                        </div>
                        <div class="header_1">
                            <p class="header_title">Amount:</p>
                            <input type="number"  min="1" class="header_2" id="amount" name="amountFood">
                        </div>
                    </div>
                    <p class="p_error" style="padding: 5px 10px; height: 24px; text-align: center; color: red;width: 100%; white-space: break-spaces;"></p>
                    <div class="controls">
                        <div class="controls_1">
                            <button id="btn-submit" type="submit" class="btn btn-primary key" style="padding: 0px 46px;">Add</button>
                            <a href="/menu" type="button" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>
                </form>
            @endif
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
        const btn_submit = document.getElementById('btn-submit');
        let title_error = document.querySelector('.p_error');
        // kiểm tra tên
        function checkName() {
            let input_name = document.getElementById('name').value;
            const regex = /^[\p{L}\s']{2,50}$/u;
            if (regex.test(input_name)) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'You must enter a valid name food!';
                btn_submit.disabled = true;
            }
        }
        // kiểm tra person
        function checkForPerson() {
            let input_forPerson = document.getElementById('forPerson').value;
            const regex = /^[1-9]\d*$|^0$/;
            if (regex.test(input_forPerson) && input_forPerson > 0) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'You must enter a valid number for the people!';
                btn_submit.disabled = true;
            }
        }
        // kiểm tra price
        function checkPrice() {
            let input_pricefood = document.getElementById('priceFood').value;
            const regex = /^\d+(\.\d{1,2})?$/;
            if (input_pricefood > 0 && regex.test(input_pricefood)) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText =
                    'You must enter the correct format greater than 0! (eg 50.50)';
                btn_submit.disabled = true;
            }
        }
        // kiểm tra Amount
        function checkAmount() {
            let input_amountfood = document.getElementById('amountFood').value;
            const regex = /^[1-9]\d*$|^0$/;
            if (regex.test(input_amountfood) && input_amountfood > 0) {
                title_error.innerText = '';
                btn_submit.disabled = false;
            } else {
                title_error.innerText = 'You must enter a valid number for the food!';
                btn_submit.disabled = true;
            }
        }
        document.getElementById('name').addEventListener('change', checkName);
        document.getElementById('forPerson').addEventListener('change', checkForPerson);
        document.getElementById('priceFood').addEventListener('change', checkPrice);
        document.getElementById('amountFood').addEventListener('change', checkAmount);


    </script>
@endsection
