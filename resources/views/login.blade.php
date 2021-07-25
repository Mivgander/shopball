@if(isset(Auth::user()->email))
<script>window.location = '/'; </script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - SHOPBALL</title>

    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">

    <style>
        header
        {
            align-items: center;
            box-shadow: rgb(0 0 0 / 20%) 0px 4px 8px 0px;
        }

        #search-input
        {
            border: 1px solid gray;
            border-right: 0px solid black;
            outline: none;
            flex-grow: 1;
        }

        .menu-item:hover .submenu
        {
            display: block;
        }

        .loginInput
        {
            border: 2px solid #888;
            border-radius: 2px;
            outline: none;
            background-color: rgba(166, 166, 166, 0.10);
            width: 100%;
            padding: 4px;
        }

        .loginSubmit
        {
            border: none;
            width: auto;
            background-color: rgb(37, 99, 235);
            padding: 6px 14px;
            text-transform: uppercase;
            font-size: 1.125rem;
        }

        .loginSubmit:hover
        {
            cursor: pointer;
            background-color: rgb(59, 130, 246);
        }

        /* Checkbox */
        .filtr-box {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .filtr-box input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 5px;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: rgb(229, 231, 235);
        }

        .filtr-box:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .filtr-box:hover .filtr-nazwa
        {
            text-decoration: underline;
        }

        .filtr-box input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .filtr-box input:checked ~ .checkmark:after {
            display: block;
        }

        .filtr-box .checkmark:after {
            left: 9px;
            top: 3px;
            width: 7px;
            height: 16px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        /* Checkbox */
    </style>
</head>
<body class="bg-gray-200">
    @include('header')

    <main class="p-10">
        <div class="bg-white p-5 max-w-3xl mx-auto block">
            <h1 class="text-3xl uppercase text-center mb-6">Zaloguj się</h1>

            @if($wiadomosc = Session::get('error'))
                <div class="bg-red-400 border-red-600 border-2 p-4">
                    <p>{{$wiadomosc}}</p>
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="bg-red-400 border-red-600 border-2 p-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="list-disc ml-3">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{url('/login')}}" method="post">
                @csrf
                <div class="my-6">
                    <label class="font-bold text-lg">Email:</label><br>
                    <input class="loginInput" type="email" name="email" placeholder="podaj email">
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Hasło:</label><br>
                    <input class="loginInput" type="password" name="password" placeholder="podaj hasło">
                </div>
                <div class="my-1">
                    <label class="filtr-box"><span class="filtr-nazwa text-lg">Nie wylogowuj</span>
                        <input type="checkbox" name="remember" value="true">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="my-6">
                    <input class="loginSubmit" type="submit" name="login" value="zaloguj się">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
