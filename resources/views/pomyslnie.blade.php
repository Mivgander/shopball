<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomyślnie dodano produkt - SHOPBALL</title>

    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">
    @livewireStyles

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
    </style>
</head>
<body class="bg-gray-200">
    @include('header')

    <main class="bg-gray-200 py-5 w-full">
        <div class="bg-white mx-auto text-center py-8" style="max-width: 1300px">
            @if(session()->has('kategoria') && session()->has('id'))
            <h1 class="text-4xl font-bold text-green-600">Pomyślnie dodano produkt</h1>
            <div class="flex flex-row justify-evenly my-6">
                <a class="text-xl bg-blue-600 hover:bg-blue-500 py-2 px-3" href="{{url('/')}}">Przejdź do strony głownej</a>
                <a class="text-xl bg-blue-600 hover:bg-blue-500 py-2 px-3" href="{{url('/produkt/'.session('kategoria').'/'.session('id'))}}">Strona produktu</a>
            </div>
            {{session()->forget(['kategoria', 'id'])}}
            @else
                <h1 class="text-4xl font-bold text-red-600">Nie dodano produktu</h1>
            @endif
        </div>

        @if(Session::has('registered'))
            {{Session::forget('registered')}}
            @include('registerConfirm')
        @endif
    </main>

    @livewireScripts
</body>
</html>
