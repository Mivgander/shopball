<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - SHOPBALL</title>

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

        .registerInput
        {
            border: 2px solid #888;
            border-radius: 2px;
            outline: none;
            background-color: rgba(166, 166, 166, 0.10);
            width: 100%;
            padding: 4px;
        }

        .registerSubmit
        {
            border: none;
            width: auto;
            background-color: rgb(37, 99, 235);
            padding: 6px 14px;
            text-transform: uppercase;
            font-size: 1.125rem;
        }

        .registerSubmit:hover
        {
            cursor: pointer;
            background-color: rgb(59, 130, 246);
        }
    </style>
</head>
<body class="bg-gray-200">
    @include('header')

    <main class="p-10">
        <div class="bg-white p-5 max-w-3xl mx-auto block">
            <h1 class="text-3xl uppercase text-center mb-6">Rejestracja</h1>

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

            <form action="{{url('/register')}}" method="post">
                @csrf
                <div class="my-6">
                    <label class="font-bold text-lg">Nazwa użytkownika:</label><br>
                    <input class="registerInput" type="text" name="nick" placeholder="podaj nazwę użytkownika">
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Email:</label><br>
                    <input class="registerInput" type="email" name="email" placeholder="podaj email">
                </div>
                <div class="my-6">
                    <label class="font-bold text-lg">Hasło:</label><br>
                    <input class="registerInput" type="password" name="password" placeholder="podaj hasło">
                </div>
                <div class="my-6">
                    <input class="registerSubmit" class="registerInput" type="submit" name="register" value="załóż konto">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
