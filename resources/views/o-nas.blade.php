<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nas - SHOPBALL</title>

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

    <main class="bg-gray-200 w-full py-4">
        <div class="bg-white mx-auto main-parent py-4 px-8">
            <h1 class="text-3xl font-bold mb-6">O nas</h1>
            <p class="text-lg mb-6">
                Nasz sklep działa na runku od 2015 roku i od tamtego czasu nieustannie się rozwijamy dzięki czemu jesteśmy obecnie
                największym sklepem sprzedającym piłki w Polsce. Dzięki połączeniu empatii oraz uczciwości zaufało nam już ponad
                1 000 000 zadowolonych klientów.
            </p>
            <hr class="border-t-2 border-gray-200">
            <h1 class="text-2xl font-bold my-6">Co nas wyróżnia?</h1>
            <ul class="px-10">
                <li class="mb-4">
                    <h2 class="text-xl font-bold">Profesjonalizm</h2>
                    <p class="text-lg">
                        Bardzo poważnie podchodzimy do tematu piłek. Każdy u nas sprzedawany produkt jest dokładnie opisany
                        parametrami, dzięki czemu znawcy mogą łatwo znaleść dokładnie to, czego szukają.
                    </p>
                </li>
                <li class="mb-4">
                    <h2 class="text-xl font-bold">Sprawdzone produkty</h2>
                    <p class="text-lg">
                        W naszym sklepie znajdziecie Państwo produkty tylko sprawdzonych marek, których piłki są wykorzystywane
                        w oficjalnych rozgrywkach sportowych. Są to najlepsze możliwe produkty.
                    </p>
                </li>
            </ul>
        </div>
    </main>
</body>
@livewireScripts
</html>
