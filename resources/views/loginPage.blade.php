@extends('share.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/loginPage.css') }}">
@endsection
@section('content')

<div class="container animate__animated animate__fadeInDown" id="container" style="position: fixed;top: 125px; left:50%; transform: translateX(-50%);">
    <div class="form-container sign-up-container">
        <form action="/login/signup" method="post">
            @csrf
            <h2 style="font-weight: bold;">Create Account</h2>
            <input name="nameUser" type="text" placeholder="Name" />
            <input name="birthday" type="date" placeholder="Birthday" />
            <input name="address" type="text" placeholder="Address" />
            <input name="phone" type="text" placeholder="Phone" />
            <input name="email" type="email" placeholder="Email" />

            <button type="submit" id="btn-signUp" style="margin-top: 10px;background-image: linear-gradient(to right, #1FA2FF 0%, #12D8FA 51%, #1FA2FF 100%);">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="/login/signin" method="post">
            @csrf
            <h1>Sign in</h1>
            <input name="username" type="text" placeholder="Username" />
            <div class="div_password">
                <input name="password" id="password_signIn" type="password" placeholder="Password" />
                <img onClick="showPass('password_signIn', 'icon_eye_signIn')" id="icon_eye_signIn" src="{{ asset('assets/images/icon_eye_open.png') }}">
            </div>



            <button type="submit" style="margin-top: 10px;">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button style="background-image: linear-gradient(to right, #1FA2FF 0%, #12D8FA 51%, #1FA2FF 100%);" class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showPass(idName, idIcon) {
        const btnEye = document.querySelector('#' + idIcon);
        const btnPass = document.querySelector('#' + idName);
        if (btnPass.type === 'password') {
            btnPass.type = "text"
            btnEye.src = '{{ asset('assets/images/icon_eye_close.png') }}'
        } else {
            btnPass.type = 'password'
            btnEye.src = '{{ asset('assets/images/icon_eye_open.png') }}'
        }
    }
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add('right-panel-active');
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove('right-panel-active');
    });
</script>
@endsection

