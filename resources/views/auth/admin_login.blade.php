<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Sujan Timalsina">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Solve MCQs. Prepare for exams.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <!-- Page Title  -->
    <title>Login | Guruja</title>
    <!-- StyleSheets  -->
    <!-- Scripts -->
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" action="{{ url('/admin/login') }}" method="POST">
                    @csrf
                    <div class="login__field">
                        <label for="email">Email</label>
                        <input type="email" class="login__input" name="email" id="email">
                    </div>
                    <div class="login__field">
                        <label for="password">Password</label>
                        <input type="password" class="login__input" name="password" id="password">
                    </div>
                    @if(session('error'))
                        <div class="text-red">{{session('error')}}</div>
                    @endif
                    <button class="button login__submit" type="submit">
                        <span class="button__text">Log In Now</span>
                    </button>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Raleway, sans-serif;
    }

    body {
        /*background: linear-gradient(90deg, #C7C5F4, #776BCC);*/
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .screen {
        background: linear-gradient(90deg, #5D54A4, #7C78B8);
        position: relative;
        height: 600px;
        width: 360px;
        box-shadow: 0px 0px 24px #5C5696;
    }

    .screen__content {
        z-index: 1;
        position: relative;
        height: 100%;
    }

    .screen__background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        -webkit-clip-path: inset(0 0 0 0);
        clip-path: inset(0 0 0 0);
    }

    .screen__background__shape {
        transform: rotate(45deg);
        position: absolute;
    }

    .screen__background__shape1 {
        height: 520px;
        width: 520px;
        background: #FFF;
        top: -50px;
        right: 120px;
        border-radius: 0 72px 0 0;
    }

    .screen__background__shape2 {
        height: 220px;
        width: 220px;
        background: #6C63AC;
        top: -172px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape3 {
        height: 540px;
        width: 190px;
        background: linear-gradient(270deg, #5D54A4, #6A679E);
        top: -24px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape4 {
        height: 400px;
        width: 200px;
        background: #7E7BB9;
        top: 420px;
        right: 50px;
        border-radius: 60px;
    }

    .login {
        width: 400px;
        padding: 30px;
        padding-top: 156px;
    }

    .login__field {
        padding: 20px 0px;
        position: relative;
        display: grid;
        gap: 10px;
        grid-column: 1/1;
        grid-row:1/1;
    }

    .login__icon {
        position: absolute;
        top: 30px;
        color: #7875B5;
    }

    .login__input {
        border: none;
        border-bottom: 2px solid #D1D1D4;
        background: none;
        padding: 10px;
        padding-left: 24px;
        font-weight: 700;
        width: 75%;
        transition: .2s;
    }

    .login__input:active,
    .login__input:focus,
    .login__input:hover {
        outline: none;
        border-bottom-color: #6A679E;
    }

    .login__submit {
        background: #fff;
        font-size: 14px;
        margin-top: 30px;
        padding: 16px 20px;
        border-radius: 26px;
        border: 1px solid #D4D3E8;
        text-transform: uppercase;
        font-weight: 700;
        display: flex;
        align-items: center;
        width: 135px;
        color: #4C489D;
        box-shadow: 0px 2px 2px #5C5696;
        cursor: pointer;
        transition: .2s;
    }

    .login__submit:active,
    .login__submit:focus,
    .login__submit:hover {
        border-color: #6A679E;
        outline: none;
    }

    .text-red{
        background-color:#DC143C;
        padding: 20px 10px;
        border-radius: 10px;
        font-size: 0.8rem;
        width: 250px;
        color: white;
    }
</style>

</html>