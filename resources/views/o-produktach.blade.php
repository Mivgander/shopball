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
            <h1 class="text-3xl font-bold mb-6">O produktach</h1>
            <p class="text-lg mb-6">
                Wiemy że nie każdy musi być ekspertem w temacie piłek, dlatego przygotowalićmy dla Państwa
                zestawienie wszystkich sprzedawanych u nas produktów, razem z wyjaśnieniem co oznaczają
                dane rozmiary piłek czy ich kategorie.
            </p>

            <hr class="border-t-2 border-gray-200">

            <h2 class="text-2xl font-bold my-6">Spis treści</h2>
            <div class="flex justify-evenly mb-6">
                <a href="#pilka-nozna" class="text-xl text-blue-600 hover:text-blue-500">Piłka nożna</a>
                <a href="#pilka-reczna" class="text-xl text-blue-600 hover:text-blue-500">Piłka ręczna</a>
                <a href="#siatkowka" class="text-xl text-blue-600 hover:text-blue-500">Siatkówka</a>
                <a href="#koszykowka" class="text-xl text-blue-600 hover:text-blue-500">Koszykówka</a>
                <a href="#tenis-ziemny" class="text-xl text-blue-600 hover:text-blue-500">Tenis ziemny</a>
                <a href="#tenis-stolowy" class="text-xl text-blue-600 hover:text-blue-500">Tenis stołowy</a>
            </div>

            <hr id="pilka-nozna" class="border-t-2 border-gray-200">

            <div class="my-8">
                <h2 class="text-2xl font-bold mb-6">Piłka nożna</h2>
                <p class="text-lg">Piłki do piłki nożnej dzielimy ze względu na rozmiar:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 5</b> - tradycyjny rozmiar, którym rozgrywane są wszystkie seniorskie rozgrywki.<br>
                            Obwód piłki: 68 - 70 cm<br>
                            Waga piłki: 415 - 445g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 4</b> - przeznaczony jest dla trampkarzy, którzy dopiero zaczynają przygodę z futbolem i są na początku swojej piłkarskiej drogi.<br>
                            Obwód piłki: 64 - 66 cm<br>
                            Waga piłki: 350 - 390g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 3</b> - jej przeznaczeniem są głównie zabawy rekreacyjne.<br>
                            Obwód piłki: 60 - 62 cm<br>
                            Waga piłki: 280 - 320g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 1</b> - służą do zabawy lub traktowane są jako element kolekcjonerski. Najczęściej są to futbolówki nawiązujące do określonego klubu piłkarskiego.<br>
                            Obwód piłki: 46 - 51 cm<br>
                            Waga piłki: 190 - 210g
                        </p>
                    </li>
                </ul>
            </div>

            <hr id="pilka-reczna" class="border-t-2 border-gray-200">

            <div class="my-8">
                <h2 class="text-2xl font-bold mb-6">Piłka ręczna</h2>
                <p class="text-lg">Piłki do piłki ręcznej dzielimy ze względu na rozmiar:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 3</b> - największy z dostępnych rozmiarów piłek do piłki ręcznej. To piłka przeznaczona do gry dla drużyn męskich od szesnastego roku życia.<br>
                            Obwód piłki: 58 - 60 cm<br>
                            Waga piłki: 425 - 475g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 2</b> - jest przeznaczony do użytku przez chłopców od dwunastego do szesnastego roku życia oraz przez drużyny żeńskie od czternastego roku życia.<br>
                            Obwód piłki: 54 - 56 cm<br>
                            Waga piłki: 325 - 375g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 1</b> - są przeznaczone do gry dla dziewczynek w wieku od ośmiu do czternastu lat i dla chłopców w wieku od ośmiu do dwunastu lat.<br>
                            Obwód piłki: 50 - 52 cm<br>
                            Waga piłki: 290 - 330g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 0</b> - dla juniorów. Piłki tego typu są przeznaczone do gry dla dzieci poniżej ósmego roku życia. Nie podlegają standaryzacji przez Międzynarodową Federację Piłki Ręcznej (IHF) więc nie ma jasno określonych parametrów, jakie muszą spełniać.
                        </p>
                    </li>
                </ul>
            </div>

            <hr id="siatkowka" class="border-t-2 border-gray-200">

            <div class="my-8">
                <h2 class="text-2xl font-bold mb-6">Siatkówka</h2>
                <p class="text-lg">Piłki do siatkówki dzielimy ze względu na rozmiar:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 5</b> - standardowy rozmiar na którym odgrywane są zawodowe mecze oraz amatorskie turnieje.<br>
                            Obwód piłki: 65 - 67 cm<br>
                            Waga piłki: 260 - 480g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 4</b> - piłki wykorzystywane do gry w mini siatkówkę.<br>
                            Obwód piłki: 62 - 64 cm<br>
                            Waga piłki: 240 - 260g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 2</b> - piłki przeznaczone dla najmłodszych. Nie mają ściśle określonych standardów.<br>
                        </p>
                    </li>
                </ul>
            </div>

            <hr id="koszykowka" class="border-t-2 border-gray-200">

            <div class="my-8">
                <h2 class="text-2xl font-bold mb-6">Koszykówka</h2>
                <p class="text-lg">Piłki do koszykówki dzielimy ze względu na rozmiar:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 7</b> - dla chłopców powyżej czternastego roku życia. Używane zarówno w amatorskich, jak i profesjonalnych rozgrywkach.<br>
                            Średnica piłki: 24 cm<br>
                            Waga piłki: 565 - 650g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 6</b> - dla dziewcząt powyżej czternastu lat i kobiet oraz chłopców, od dwunastu do czternastu lat.<br>
                            Średnica piłki: 23 cm<br>
                            Waga piłki: 530 - 550g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 5</b> - dla dziewcząt do czternastu lat i chłopców do dwunastu lat. Przeważnie wykorzystuje się je w szkołach.<br>
                            Średnica piłki: 22 cm<br>
                            Waga piłki: 300 - 350g
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Rozmiar 3</b> - dla dzieci do 6 roku życia.<br>
                            Średnica piłki: 18 cm<br>
                            Waga piłki: 300 - 350g
                        </p>
                    </li>
                </ul>
            </div>

            <hr id="tenis-ziemny" class="border-t-2 border-gray-200">

            <div class="my-8">
                <h2 class="text-2xl font-bold mb-6">Tenis ziemny</h2>
                <p class="text-lg">Piłki do tenisa ziemnego dzielimy ze względu na typ wykonania:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>Piłki ciśnieniowe</b> - ich produkcja polega na połączeniu dwóch połówek piłki w atmosferze bardzo wysokiego
                            ciśnienia przy użyciu gazu, który pozostaje w środku piłki, osiągając nawet do sześciu atmosfer.
                            Piłki ciśnieniowe muszą być pakowane w hermetycznie zamknięte opakowania, tak by zawarty w nich
                            gaz się nie ulotnił. Ten rodzaj piłek jest używany głównie przez profesjonalnych zawodników,
                            którzy w trakcie meczu często zmieniają piłki. Można wówczas usłyszeć charakterystyczny dźwięk
                            otwierania puszki z nowym zestawem piłek. Tak częste zmiany wynikają z dużej siły uderzeń piłek,
                            w których systematycznie zmniejsza się objętość gazu.
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Piłki bezciśnieniowe</b> - piłki zrobione z grubszego kauczuku, przez co są znacznie twardsze
                            i cięższe od piłek ciśnieniowych. Ciężar wpływa nie tylko na komfort gry, ale także utrudnia
                            kontrolę nad lotem. Brak gazu w wypełnieniu piłek bezciśnieniowych pozwala na ich dłuższe użytkowanie.
                            Ten typ piłek polecany jest dla osób grających okazjonalnie lub podczas treningu.
                            Piłki bezciśnieniowe rekomendowane są też dla osób rozpoczynających przygodę na tenisowym korcie.
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Piłki niskociśnieniowe</b> - alternatywą dla utrudniających utrzymanie kontroli nad grą piłek
                            bezciśnieniowych są piłki tworzone z myślą o najmłodszych graczach. Piłki soft są zdecydowanie
                            bardziej miękkie od tych standardowych. Dzięki temu najmłodsi mogą swobodnie trenować, powoli
                            nabierając siły w mięśniach. Piłki niskociśnieniowe mają cienkie ścianki, dzięki którym są
                            bardzo lekkie. Ciśnienie zawarte w piłce pozwala na uzyskanie większej kontroli nad uderzeniem i rotacją.
                        </p>
                    </li>
                </ul>
                <p class="text-lg my-4">
                    Wszystkie piłki podlegają tym samym kryteriom wagowym i rozmiarowym:<br>
                    Średnica piłki: 6,35 - 6,86 cm<br>
                    Waga piłki: 56 - 59,4g
                </p>
                <p class="text-lg">Jednak co ciekawe kolor piłek tenisowych też ma znaczenie:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>Biały lub żółty</b> - piłki przeznaczone dla dorosłych.
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Zielony STAGE 1</b> - piłki zielone, dla dzieci w wieku 9-10 lat, 25% wolniejsze od regularnych.<br>
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Pomarańczowy STAGE 2</b> - piłki do tenisa pomarańczowe, dla dzieci w wieku 8-9 lat, 50% wolniejsze od regularnych.<br>
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Czerwony STAGE 3</b> - piłki gąbkowe i czerwone, dla dzieci w wieku 5-7 lat, 75% wolniejsze od regularnych.<br>
                        </p>
                    </li>
                </ul>
            </div>

            <hr id="tenis-stolowy" class="border-t-2 border-gray-200">

            <div class="my-8">
                <h2 class="text-2xl font-bold mb-6">Tenis stołowy</h2>
                <p class="text-lg">Piłki do tenisa stołowego dzielimy ze względu na gwiazdki:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>1 gwiazdka</b> - piłeczki spełniające wszystkie wymagania MFTS (Międzynarodowa Federacja Tenisa Stołowego). Z takich piłeczek korzystają gracze podczas oficjalnych zawodów.<br>
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>2 gwiazdki</b> - przeznaczone są do graczy średniozaawansowanych, głównie do gry rekreacyjnej.<br>
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>3 gwiazdki</b> - dedykowane są graczom początkującym. Takie piłeczki są dość wolne, a tor ich lotu jest dość przewidywalny.<br>
                        </p>
                    </li>
                </ul>
                <p class="text-lg my-4">
                    Wszystkie piłki chcące dostać 1 gwiazdkę podlegają tym samym kryteriom wagowym i rozmiarowym:<br>
                    Średnica piłki: 40 mm<br>
                    Waga piłki: 2,7g
                </p>
                <p class="text-lg">MFTS kategoryzje piłeczki również po kolorze:</p>
                <ul class="list-disc ml-14 my-4">
                    <li>
                        <p class="text-lg">
                            <b>Biały</b> - piłeczki przeznaczone do gry na zielonym stole.<br>
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Pomarańczowy</b> - piłeczki przeznaczone do gry na niebieskim stole.<br>
                        </p>
                    </li>
                    <li>
                        <p class="text-lg">
                            <b>Inny kolor</b> - piłeczki przeznaczone do gry rekreacyjnej.<br>
                        </p>
                    </li>
                </ul>
                <p class="text-lg mb-4">Oczywiście są to zasady obowiązujące tylko na oficjalnych meczach i turniejach.</p>
            </div>
        </div>
    </main>
</body>
@livewireScripts
</html>
