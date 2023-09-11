@if(Session::has('error') || $errors->any())
    <div style="margin-top:60px; --bs-bg-opacity: .9; position:fixed ; z-index:99;left: 50%; top: 0; " class=" toast align-items-center bg-danger text-white start-50 animate__animated animate__fadeInDown" role="status" aria-live="polite" aria-atomic="true" data-bs-animation="false" data-bs-autohide="true" data-bs-delay="5000">

        <div class="d-flex  ">
            <div class="toast-body ">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                @else
                    {{Session::get('error')}}
                @endif

            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.toast').toast('show');

            $('.toast').on('hidden.bs.toast', function () {
                $(this).removeClass('hide').addClass('show');
                // Thêm lớp animate__animated animate__fadeOutUp vào Toast trước khi ẩn nó
                $(this).addClass('animate__animated animate__fadeOutUp');


                // Đợi cho animation hoàn thành trước khi ẩn Toast
                setTimeout(function() {
                    $(this).hide();
                }.bind(this), 1500); // thời gian animation, tương ứng với duration của animate__fadeOutUp
            });
        });
    </script>
@endif


@if(Session::has('success'))
    <div style="margin-top:60px; --bs-bg-opacity: .9; position:fixed ; z-index:99;left: 50%; top: 0;  " class=" toast align-items-center bg-success text-white start-50 animate__animated animate__fadeInDown " role="status" aria-live="polite" aria-atomic="true" data-bs-animation="false" data-bs-autohide="true" data-bs-delay="5000">

        <div class="d-flex  ">
            <div class="toast-body ">
                {{Session::get('success')}}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.toast').toast('show');

            $('.toast').on('hidden.bs.toast', function () {
                $(this).removeClass('hide').addClass('show');
                // Thêm lớp animate__animated animate__fadeOutUp vào Toast trước khi ẩn nó
                $(this).addClass('animate__animated animate__fadeOutUp');

                // Đợi cho animation hoàn thành trước khi ẩn Toast
                setTimeout(function() {
                    $(this).hide();
                }.bind(this), 1500); // thời gian animation, tương ứng với duration của animate__fadeOutUp
            });
        });
    </script>
@endif
