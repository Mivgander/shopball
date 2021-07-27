<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPBALL</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick/slick-theme.css') }}"/>

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
<body class="text-black">
    @include('header')

    <main class="w-full bg-gray-200 flex flex-col items-center">
        <section class="w-full flex flex-row">
            <div class="w-2/3 ml-4 my-4 cool-shadow">
                <div class="your-class">
                    <div><img src="{{ asset('img/slider1.jpg') }}" alt="slider1" style="width: 100%; height: 500px;"></div>
                    <div><img src="{{ asset('img/slider2.jpg') }}" alt="slider2" style="width: 100%; height: 500px;"></div>
                    <div><img src="{{ asset('img/slider3.jpg') }}" alt="slider3" style="width: 100%; height: 500px;"></div>
                </div>
            </div>

            <div class="w-1/3 h-full bg-white m-4 p-4 text-center cool-shadow" style="height: 500px;">
                <h1 class="text-blue-600 text-3xl uppercase font-bold">Produkt dnia</h1>

                <br><hr class="border-t-2 border-gray-200"><br>

                <a href="{{ url('/produkt/'.$produktDnia->kategoriaURL.'/'.$produktDnia->query->id) }}" class="cursor-pointer">
                    <img src="{{ asset('images/'.$produktDnia->query->zdjecie) }}" alt="piłka tenis ziemny" style="max-height: 300px; width: auto; margin: 5px auto;">
                    <div>
                        <h2 class="text-left text-xl font-bold">{{number_format($produktDnia->query->cena, 2, ',', ' ')}} zł</h2>
                        <h2 class="text-left text-xl">{{$produktDnia->query->tytul}}</h2>
                    </div>
                </a>
            </div>
        </section>

        <section class="w-full flex flex-col mb-4">
            <div class="bg-white mx-4 p-4 cool-shadow">
                <h1 class="text-blue-600 text-3xl mb-2 font-bold">Polecane</h1>

                <div class="bg-white w-full flex flex-row">
                    @foreach($polecane as $row)
                    <a href="{{ asset('produkt/'.$row->kategoriaURL.'/'.$row->query[0]->id) }}" class=" w-1/5 polecane cursor-pointer p-4">
                        <div>
                            <img src="{{ asset('images/'.$row->query[0]->zdjecie) }}" style="height: 200px; margin: 0 auto;">
                        </div>
                        <div>
                            <h2 class="cena text-left text-lg font-bold">{{number_format($row->query[0]->cena, 2, ',', ' ')}} zł</h2>
                            <h2 class="produkt text-left text-lg">{{$row->query[0]->tytul}}</h2>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </section>

        @if(Session::has('registered'))
            {{Session::forget('registered')}}
            @include('registerConfirm')
        @endif
    </main>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('slick/slick/slick.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.your-class').slick({
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev" style="position: absolute; left: 10px; z-index: 3;">Previous</button>',
                nextArrow: '<button type="button" class="slick-next" style="position: absolute; right: 10px; z-index: 3;">Previous</button>',
                autoplay: true,
                autoplaySpeed: 5000
            });
        });
    </script>
</body>
</html>
