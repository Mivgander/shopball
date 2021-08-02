<style>
    #konto-btn
    {
        background-color: white;
    }

    #konto-btn:hover
    {
        background-color: #eee;
    }
</style>

<header class="w-full flex justify-between fixed z-20 bg-white" style="height: 70px">
        <h1 class="text-4xl font-bold uppercase text-blue-600 cursor-pointer pl-3"><a href="{{ url('/') }}">shopball</a></h1>

        <div class="w-2/5">
            <form action="/szukaj" method="get" class="flex">
                @livewire('search-input')
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-xl p-2">Szukaj</button>
            </form>
        </div>

        <div class="text-xl flex flex-row">
            @if(Auth::check())
            <div class="mr-7" style="height: 70px">
                <a href="{{ url('/koszyk') }}" class="cursor-pointer hover:underline menu-a">Koszyk&#160<span class="text-blue-600">({{App\Models\Koszyk::where('id_klienta', Auth::user()->id)->count()}})</span></a>
            </div>
            <div class="mr-7 menu-item" style="height: 70px">
                <a href="{{ url('/konto') }}" class="cursor-pointer hover:underline menu-a">Konto</a>
                <section class="submenu hidden absolute right-2" style="top: 70px">
                    <ul class="flex flex-col">
                        <li class="submenu-element p-2" id="konto-btn"><a href="{{ url('wyloguj') }}" class="menu-a">Wyloguj</a></li>
                    </ul>
                </section>
            </div>
            @else
            <div class="mr-7">
                <a href="{{ url('/login') }}" class="cursor-pointer hover:underline">Zaloguj się</a>
            </div>
            <div class="mr-7">
                <a href="{{ url('/register') }}" class="cursor-pointer hover:underline">Zarejestruj się</a>
            </div>
            @endif
        </div>
    </header>
    <div id="placeholder" style="width: 100%; height: 70px;"></div>

    <div class="w-full bg-blue-600 px-10">
        <ul class="h-16 flex flex-row justify-center text-xl text-center uppercase">
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ url('/kategoria/pilka-nozna') }}" class="menu-a">Piłka nożna</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-nozna') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-nozna?rozmiar%5B%5D=5') }}" class="menu-a">Rozmiar 5</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-nozna?rozmiar%5B%5D=4') }}" class="menu-a">Rozmiar 4</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-nozna?rozmiar%5B%5D=3') }}" class="menu-a">Rozmiar 3</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-nozna?rozmiar%5B%5D=1') }}" class="menu-a">Rozmiar 1</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ url('/kategoria/pilka-reczna') }}" class="menu-a">Piłka ręczna</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-reczna') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-reczna?rozmiar%5B%5D=3') }}" class="menu-a">Rozmiar 3</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-reczna?rozmiar%5B%5D=2') }}" class="menu-a">Rozmiar 2</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-reczna?rozmiar%5B%5D=1') }}" class="menu-a">Rozmiar 1</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/pilka-reczna?rozmiar%5B%5D=0') }}" class="menu-a">Rozmiar 0</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ url('/kategoria/siatkowka') }}" class="menu-a">Siatkówka</a>
                <section class="submenu hidden w-36 absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ url('/kategoria/siatkowka') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/siatkowka?rozmiar%5B%5D=5') }}" class="menu-a">Rozmiar 5</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/siatkowka?rozmiar%5B%5D=4') }}" class="menu-a">Rozmiar 4</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/siatkowka?rozmiar%5B%5D=2') }}" class="menu-a">Rozmiar 2</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ url('/kategoria/koszykowka') }}" class="menu-a">Koszykówka</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ url('/kategoria/koszykowka') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/koszykowka?rozmiar%5B%5D=7') }}" class="menu-a">Rozmiar 7</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/koszykowka?rozmiar%5B%5D=6') }}" class="menu-a">Rozmiar 6</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/koszykowka?rozmiar%5B%5D=5') }}" class="menu-a">Rozmiar 5</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/koszykowka?rozmiar%5B%5D=3') }}" class="menu-a">Rozmiar 3</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ url('/kategoria/tenis-ziemny') }}" class="menu-a">Tenis ziemny</a>
                <section class="submenu hidden w-52 absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-ziemny') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-ziemny?typ%5B%5D=ciśnieniowe') }}" class="menu-a">Ciśnieniowe</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-ziemny?typ%5B%5D=bezciśnieniowe') }}" class="menu-a">Bezciśnieniowe</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-ziemny?typ%5B%5D=niskociśnieniowe') }}" class="menu-a">Niskociśnieniowe</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ url('/kategoria/tenis-stolowy') }}" class="menu-a">Tenis stołowy</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-stolowy') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-stolowy?typ%5B%5D=3+gwiazdki') }}" class="menu-a">3 gwiazdki</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-stolowy?typ%5B%5D=2+gwiazdki') }}" class="menu-a">2 gwiazdki</a></li>
                        <li class="submenu-element"><a href="{{ url('/kategoria/tenis-stolowy?typ%5B%5D=1+gwiazdka') }}" class="menu-a">1 gwiazdka</a></li>
                    </ul>
                </section>
            </li>
        </ul>
    </div>
