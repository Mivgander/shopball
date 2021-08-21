<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$produkt->tytul}} - SHOPBALL</title>

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

        .polecane:hover
        {
            box-shadow: rgb(37 99 235 / 12%) 0px 0px 8px;
            border-radius: 3px;
        }

        .polecane:hover .produkt
        {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @include('header')

    <main class="bg-gray-200 py-5 w-full">
        <div class="bg-white mx-auto flex flex-row" style="max-width: 1300px">
            <div class="w-1/2 p-6">
                <img src="{{asset('images/'.$produkt->zdjecie)}}" class="mx-auto" style="height: 100%; max-height: 500px">
            </div>
            <div class="w-1/2 p-6 ml-6" style="display: flex; flex-direction: column; justify-content: center; align-items: baseline;">
                <h1 class="text-xl font-bold">{{$produkt->tytul}}</h1>
                <h2 class="text-lg font-bold">{{number_format($produkt->cena, 2, ',', ' ')}} zł</h2>
                @if(Auth::check())
                    <button data-id="{{$produkt->id}}" data-kategoria="{{$nazwa}}" id="koszyk" class="mt-5 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-lg">Dodaj do koszyka</button>
                @else
                    <p class="mt-5 text-red-700 text-lg">Zaloguj się aby dodać do koszyka</p>
                @endif
            </div>
        </div>

        <div class="bg-white mx-auto p-6 pr-28 mt-5 leading-snug" style="max-width: 1300px">
            <h1 class="text-2xl font-bold mb-5">Opis</h1>
            <p class="text-xl"><?php echo $produkt->opis; ?></p>
        </div>

        <div class="bg-white mx-auto p-6 mt-5" style="max-width: 1300px">
            <div class="mb-5">
                <h1 class="text-2xl font-bold">Parametry</h1>
            </div>
            <div class="flex flex-row flex-wrap">
                @foreach($parametry as $parametr)
                <div class="w-1/2 flex mb-2">
                    <div class="w-2/5">
                        <span class="text-gray-500">{{$parametr[0]}}:</span>
                    </div>
                    <div class="w-3/5">
                        {{$parametr[1]}}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white mx-auto p-6 mt-5" style="max-width: 1300px">
            <div class="mb-5">
                <h1 class="text-2xl font-bold">Podobne produkty</h1>
            </div>
            <div class="bg-white w-full flex flex-row">
                @foreach($podobne as $row)
                <a href="{{ asset('produkt/'.$row->kategoriaURL.'/'.$row->query->id) }}" class=" w-1/5 polecane cursor-pointer p-4">
                    <div>
                        <img src="{{ asset('images/'.$row->query->zdjecie) }}" style="height: 200px; margin: 0 auto;">
                    </div>
                    <div>
                        <h2 class="cena text-left text-lg font-bold">{{number_format($row->query->cena, 2, ',', ' ')}} zł</h2>
                        <h2 class="produkt text-left text-lg">{{$row->query->tytul}}</h2>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        @if(Session::has('registered'))
            {{Session::forget('registered')}}
            @include('registerConfirm')
        @endif
    </main>

    <script>
        const btn = document.getElementById("koszyk");

        btn.addEventListener('click', event => {
            window.location = '/koszyk/dodaj/' + btn.dataset.kategoria + '/' + btn.dataset.id;
        });
    </script>
    @livewireScripts
</body>
</html>
