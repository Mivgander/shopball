<header class="w-full flex justify-between fixed z-10 bg-white p-3">
        <h1 class="text-4xl font-bold uppercase text-blue-600 cursor-pointer"><a href="{{ asset('/') }}">shopball</a></h1>

        <div class="w-2/5">
            <form action="/search" method="get" class="flex">
                <input required autocomplete="off" type="text" name="q" id="search-input" class="text-xl p-2">
                <button type="submit" name="submit" class="bg-blue-600 hover:bg-blue-500 text-xl p-2">Szukaj</button>
            </form>
        </div>

        <div class="text-xl flex flex-row">
            <div class="mr-7">
                <a class="cursor-pointer hover:underline">Koszyk</a>
            </div>
            <div class="mr-7">
                <a class="cursor-pointer hover:underline">Konto</a>
            </div>
        </div>
    </header>
    <div id="placeholder" style="width: 100%; height: 70px;"></div>

    <div class="w-full bg-blue-600 px-10">
        <ul class="h-16 flex flex-row justify-center text-xl text-center uppercase">
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ asset('/kategoria/pilka-nozna') }}" class="menu-a">Piłka nożna</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-nozna') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-nozna?rozmiar%5B%5D=5') }}" class="menu-a">Rozmiar 5</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-nozna?rozmiar%5B%5D=4') }}" class="menu-a">Rozmiar 4</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-nozna?rozmiar%5B%5D=3') }}" class="menu-a">Rozmiar 3</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-nozna?rozmiar%5B%5D=1') }}" class="menu-a">Rozmiar 1</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ asset('/kategoria/pilka-reczna') }}" class="menu-a">Piłka ręczna</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-reczna') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-reczna?rozmiar%5B%5D=3') }}" class="menu-a">Rozmiar 3</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-reczna?rozmiar%5B%5D=2') }}" class="menu-a">Rozmiar 2</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-reczna?rozmiar%5B%5D=1') }}" class="menu-a">Rozmiar 1</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/pilka-reczna?rozmiar%5B%5D=0') }}" class="menu-a">Rozmiar 0</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ asset('/kategoria/siatkowka') }}" class="menu-a">Siatkówka</a>
                <section class="submenu hidden w-36 absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ asset('/kategoria/siatkowka') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/siatkowka?rozmiar%5B%5D=5') }}" class="menu-a">Rozmiar 5</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/siatkowka?rozmiar%5B%5D=4') }}" class="menu-a">Rozmiar 4</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/siatkowka?rozmiar%5B%5D=2') }}" class="menu-a">Rozmiar 2</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ asset('/kategoria/koszykowka') }}" class="menu-a">Koszykówka</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ asset('/kategoria/koszykowka') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/koszykowka?rozmiar%5B%5D=7') }}" class="menu-a">Rozmiar 7</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/koszykowka?rozmiar%5B%5D=6') }}" class="menu-a">Rozmiar 6</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/koszykowka?rozmiar%5B%5D=5') }}" class="menu-a">Rozmiar 5</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/koszykowka?rozmiar%5B%5D=3') }}" class="menu-a">Rozmiar 3</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ asset('/kategoria/tenis-ziemny') }}" class="menu-a">Tenis ziemny</a>
                <section class="submenu hidden w-52 absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-ziemny') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-ziemny?typ%5B%5D=ciśnieniowe') }}" class="menu-a">Ciśnieniowe</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-ziemny?typ%5B%5D=bezciśnieniowe') }}" class="menu-a">Bezciśnieniowe</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-ziemny?typ%5B%5D=niskociśnieniowe') }}" class="menu-a">Niskociśnieniowe</a></li>
                    </ul>
                </section>
            </li>
            <li class="menu-item h-full mx-8 relative px-2 hover:bg-blue-500">
                <a href="{{ asset('/kategoria/tenis-stolowy') }}" class="menu-a">Tenis stołowy</a>
                <section class="submenu hidden w-full absolute top-16 left-0 bg-blue-600">
                    <ul class="flex flex-col">
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-stolowy') }}" class="menu-a">Wszystkie</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-stolowy?typ%5B%5D=3+gwiazdki') }}" class="menu-a">3 gwiazdki</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-stolowy?typ%5B%5D=2+gwiazdki') }}" class="menu-a">2 gwiazdki</a></li>
                        <li class="submenu-element"><a href="{{ asset('/kategoria/tenis-stolowy?typ%5B%5D=1+gwiazdka') }}" class="menu-a">1 gwiazdka</a></li>
                    </ul>
                </section>
            </li>
        </ul>
    </div>
