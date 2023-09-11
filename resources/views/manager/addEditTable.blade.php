@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/TH_AddTable.css') }}">
@endsection
@section('content')
    <div class="div_container">
        <div class="human-list dish-box">
            @if (isset($table))
            <form id="uploadImg-form" action="" accept-charset="utf-8" method="post" enctype="multipart/form-data">
                @csrf
                <div class="text-center box gr-img">
                    <div class="dist-img">
                        <div style="position:relative">
                            @if ($table->imgTable)
                            <img src="{{ asset('upload/table/'.$table->imgTable) }}" alt="avatar" id="img-preview">
                            @else
                                <img src="{{ asset('upload/table/table.png') }}" alt="avatar" id="img-preview">
                            @endif
                            <input type="file" accept=".jpg, .jpeg, .png" name="imgTable" id="img-upload" style="display:none">
                            <div class="camera-above">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <input id="img-input" type="text" value="{{$table->imgTable}}" name="oldFileName" style="display: none;">
                <input type="number" name="idTable" value="{{$table->idTable}}" style="display: none">
                <div>
                    <h1 class="header_0"> Edit Table</h1>
                    <div class="header__one">
                        <div class="header_1">
                            <p class="header_title" style="padding-left: 11%;">Type:</p>
                            <div class="type_input">
                                <input type="number" min="1" class="header_21" id="typeTable" name="typeTable" value="{{$table->typeTable}}">
                                <p class="header_title"style="padding-left: 5%;">people</p>
                            </div>
                        </div>
                        <div class="header_1">
                            <p class="header_title">Amount:</p>
                            <input type="number" class="header_2" id="amountTable" name="amountTable" value="{{$table->amountTable}}">
                        </div>
                    </div>
                    <p class="p_error" style="padding: 5px 10px; height: 24px;"></p>
                    <div class="controls">
                        <div class="controls_1">
                            <button id="btn-submit" type="submit" class="btn btn-primary key" style="padding: 0px 46px;">Update</button>
                            <a href="/admin/listTable" type="button" class="btn btn-primary key">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
            @else
                <form id="uploadImg-form" action="" accept-charset="utf-8" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center box gr-img">
                        <div class="dist-img">
                            <div style="position:relative">
                                <img src="{{ asset('upload/table/table.png') }}" alt="avatar" id="img-preview">

                                <input type="file" accept=".jpg, .jpeg, .png" name="imgTable" id="img-upload" style="display:none">
                                <div class="camera-above">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h1 class="header_0"> Add Table</h1>
                        <div class="header__one">
                            <div class="header_1">
                                <p class="header_title" style="padding-left: 11%;">Type:</p>
                                <div class="type_input">
                                    <input type="number" min="1" class="header_21" id="typeTable" name="typeTable" >
                                    <p class="header_title"style="padding-left: 5%;">people</p>
                                </div>
                            </div>
                            <div class="header_1">
                                <p class="header_title">Amount:</p>
                                <input type="number" class="header_2" id="amountTable" name="amountTable" >
                            </div>
                        </div>
                        <p class="p_error" style="padding: 5px 10px; height: 24px;"></p>
                        <div class="controls">
                            <div class="controls_1">
                                <button id="btn-submit" type="submit" class="btn btn-primary key" style="padding: 0px 46px;">Add</button>
                                <a href="/admin/listTable" type="button" class="btn btn-primary key">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <script src="{{ asset('assets/javascript/TH_AddTable.js') }}"></script>

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
