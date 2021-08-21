<!DOCTYPE html>
<html lang="PL-pl">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk - SHOPBALL</title>

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
            @if(count($produkty) > 0)
                <section class="bg-white w-full p-4 text-center">
                    <h1 class="text-3xl uppercase font-bold">Twój koszyk</h1>
                </section>
                <section class="bg-white w-full p-4">
                    @if($wiadomosc = Session::get('error'))
                        <div class="bg-red-400 border-red-600 border-2 p-4">
                            <p>{{$wiadomosc}}</p>
                        </div>
                    @endif
                    <?php $suma = 0; ?>
                    @foreach($produkty as $produkt)
                    <?php $suma += $produkt->query[0]->cena; ?>
                        <div class="mx-3 p-3 bg-white flex flex-row flex-wrap border-b-2 border-gray-200">
                            <a href="{{ asset('/produkt/'.$produkt->kategoriaURL.'/'.$produkt->query[0]->id) }}" class="mr-5 cursor-pointer" style="width: 150px; height: 150px;">
                                <img src="{{ asset('images/'.$produkt->query[0]->zdjecie) }}" style="max-height: 150px; max-width: 150px" class="mx-auto">
                            </a>
                            <div style="width: calc(100% - 180px)">
                                <a href="{{ asset('/produkt/'.$produkt->kategoriaURL.'/'.$produkt->query[0]->id) }}" class="hover:underline cursor-pointer">
                                    <h2 class="text-xl">{{$produkt->query[0]->tytul}}</h2>
                                </a>
                                <h1 class="text-3xl font-bold">{{number_format($produkt->query[0]->cena, 2, ',', ' ')}} zł</h1>
                                <div>
                                    <button data-id="{{$produkt->query[0]->id}}" data-kategoria="{{$produkt->kategoriaURL}}" class="koszyk mt-5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-lg">Usuń z koszyka</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>
                <section class="bg-white w-full p-4">
                    <div class="mx-3 p-3 flex">
                        <div class="mr-5" style="width: 150px; height: 70px;"></div>
                        <p class="text-4xl">Suma: <span class="font-bold">{{number_format($suma, 2, ',', ' ')}} zł</span></p>
                    </div>
                </section>
            @else
            <section class="bg-white w-full p-4 text-center">
                    <h1 class="text-3xl text-red-700 uppercase font-bold">Twój koszyk jest pusty</h1>
                </section>
            @endif
        </div>
    </main>
    <script>
        var btns = document.getElementsByClassName("koszyk");

        for(let i=0; i<btns.length; i++)
        {
            btns[i].addEventListener('click', event => {
                window.location = '/koszyk/usun/' + btns[i].dataset.kategoria + '/' + btns[i].dataset.id;
            });
        }
    </script>
    @livewireScripts
</body>
</html>
