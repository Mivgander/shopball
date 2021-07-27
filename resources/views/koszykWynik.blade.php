<!DOCTYPE html>
<html lang="PL-pl">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodano produkt - SHOPBALL</title>

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

        .cool-shadow
        {
            box-shadow: rgb(0 0 0 / 8%) 0px 0px 8px 0px;
        }

        .main-parent
        {
            max-width: 1300px;
        }
    </style>
</head>
<body class="bg-gray-200">
    @include('header')

    <main class=" w-full bg-gray-200 py-4">
        <div class="main-parent w-full mx-auto flex flex-col items-start">
            @if($wynik == true)
            <section class="bg-white w-full p-4 text-center">
                <h1 class="text-3xl text-green-700 uppercase font-bold">Produkt dodano do koszyka</h1>
            </section>
            <div class="w-full flex flex-row">
                <section class="bg-white w-3/4 p-4">
                    <div class="w-full mx-3 p-3 bg-white flex flex-row flex-wrap">
                        <a href="#elosiema" class="mr-5 cursor-pointer" style="width: 150px; height: 150px;">
                            <img src="{{ asset('images/'.$produkt->zdjecie) }}" style="max-height: 150px; max-width: 150px" class="mx-auto">
                        </a>
                        <div style="width: calc(100% - 180px)">
                            <h2 class="text-xl">{{$produkt->tytul}}</h2>
                            <h1 class="text-3xl font-bold">{{number_format($produkt->cena, 2, ',', ' ')}} zł</h1>
                        </div>
                    </div>
                </section>
                <section class="bg-white w-1/4 p-4" style="display: flex; flex-direction: column; justify-content: space-evenly; align-items: center;">
                    <div>
                        <a href="{{ url(Session::get('prevURL')) }}" class="mt-5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-lg cursor-pointer">Kontynuuj zakupy</a>
                    </div>
                    <div>
                        <a href="{{ url('koszyk') }}" class="mt-5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-lg cursor-pointer">Przejdź do koszyka</a>
                    </div>
                </section>
            </div>
            @else
            <section class="bg-white w-full p-4 text-center">
                <h1 class="text-3xl uppercase font-bold">Wystąpił błąd podczas dodawania produktu</h1>
                <div class="mt-4" style="display: flex; justify-content: center; align-items: center;">
                    <div class="m-4">
                        <a href="{{ url(Session::get('prevURL')) }}" class="mt-5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-lg cursor-pointer">Powrót</a>
                    </div>
                    <div class="m-4">
                        <a href="{{ url('koszyk') }}" class="mt-5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-lg cursor-pointer">Przejdź do koszyka</a>
                    </div>
                </div>
            </section>
            @endif
        </div>
    </main>
</body>
</html>
