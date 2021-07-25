<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$tytul}} - SHOPBALL</title>

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

    <main class="w-full bg-gray-200 my-4">
        <div class="main-parent w-full mx-auto bg-gray-200 my-10">
            <h1 class="text-5xl uppercase">{{$tytul}} <span class="text-4xl">({{$produkty->total()}})</span></h1>
        </div>

        <div class="main-parent w-full mx-auto flex flex-row items-start">
            <div class="mr-4 p-6 bg-white" style="width: 310px;">
                <div class="block">
                    <h1 class="text-3xl">Filtry</h1><br>
                    <a href="./{{$nazwa}}" class="text-xl px-4 py-2 font-bold bg-blue-600 hover:bg-blue-500">Wyczyść filtry</a>
                </div>
                <div class="mt-14">
                    <form action="{{ route('kategorie', ['nazwa'=>$nazwa]) }}" method="get">
                        @csrf

                        <div class="mt-8">
                            <h2 class="text-2xl">Cena</h2>
                            <div class="mt-4 flex flex-row justify-center">
                                <input type="number" name="od" placeholder="od" min="0" @if(isset($_REQUEST['od']) && $_REQUEST['od'] != '') value="{{$_REQUEST['od']}}" @endif  class="border-2 border-gray-400 outline-none w-1/3 text-sm p-1 hover:border-gray-700 focus:border-gray-700">
                                &#160&#160-&#160&#160
                                <input type="number" name="do" placeholder="do" min="0" @if(isset($_REQUEST['do']) && $_REQUEST['do'] != '') value="{{$_REQUEST['do']}}" @endif class="border-2 border-gray-400 outline-none w-1/3 text-sm p-1 hover:border-gray-700 focus:border-gray-700">
                            </div>

                        </div>

                        @foreach($filtry as $filtr)
                        <div class="mt-8">
                            <h2 class="text-2xl">{{mb_strtoupper(mb_substr($filtr->nazwa, 0, 1)) . mb_substr($filtr->nazwa, 1);}}</h2>
                            <div class="mt-4">
                                @foreach($filtr->query as $query)
                                <label class="filtr-box"><span class="filtr-nazwa text-xl">{{$query->param}}</span> <span class="text-base">({{$query->ile}})</span>
                                    <input type="checkbox" name="{{$filtr->nazwa}}[]" value="{{$query->param}}" <?php if(isset($_REQUEST[$filtr->nazwa])) echo 'checked'; ?>>
                                    <span class="checkmark"></span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        <div class="mt-8 flex justify-between">
                            <button id="fBtn" type="submit" class="text-xl px-4 py-2 w-full font-bold mx-auto bg-blue-600 hover:bg-blue-500">Filtruj</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-3/4 bg-white p-2">
                <div class="mb-6 mt-4 mx-3">
                    {{$produkty->links()}}
                </div>

                <?php $a = 0; ?>
                @foreach($produkty as $produkt)
                    <div class="mx-3 p-3 bg-white flex flex-row flex-wrap border-b-2 border-gray-200">
                        <a href="#elosiema" class="mr-5 cursor-pointer" style="width: 150px; height: 150px;">
                            <img src="{{ asset('images/'.$produkt->zdjecie) }}" style="max-height: 150px; max-width: 150px" class="mx-auto">
                        </a>
                        <div style="width: calc(100% - 180px)">
                            <a href="{{ asset('/produkt/'.$nazwa.'/'.$produkt->id) }}" class="hover:underline cursor-pointer">
                                <h2 class="text-xl">{{$produkt->tytul}}</h2>
                            </a>
                            <p class="text-sm">
                                <?php $b = 0; ?>
                                @foreach($filtry as $filtr)
                                    <span class="text-gray-500">{{$filtr->nazwa}}:</span> {{$parametry[$b][$a]}}&#160&#160
                                    <?php $b++; ?>
                                @endforeach
                            </p>
                            <h1 class="text-3xl font-bold">{{number_format($produkt->cena, 2, ',', ' ')}} zł</h1>
                            @if(isset(Auth::user()->email))
                                <div>
                                    <button data-id="{{$produkt->id}}" data-kategoria="{{$nazwa}}" class="koszyk mt-5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-lg">Dodaj do koszyka</button>
                                </div>
                            @else
                                <p class="mt-5 text-red-700 text-lg">Zaloguj się aby dodać do koszyka</p>
                            @endif
                        </div>
                    </div>
                    <?php $a++; ?>
                @endforeach

                <div class="mt-6 mb-4 mx-3">
                    {{$produkty->links()}}
                </div>
            </div>
        </div>
    </main>

    <script>
        var btns = document.getElementsByClassName("koszyk");

        for(let i=0; i<btns.length; i++)
        {
            btns[i].addEventListener('click', event => {
                window.location = '/koszyk/dodaj/' + btns[i].dataset.kategoria + '/' + btns[i].dataset.id;
            });
        }
    </script>
</body>
</html>
