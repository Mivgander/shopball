<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konto - SHOPBALL</title>

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

        .formInput
        {
            border: 2px solid #888;
            border-radius: 2px;
            outline: none;
            background-color: rgba(166, 166, 166, 0.10);
            padding: 4px;
        }

        .formSubmit
        {
            border: none;
            width: auto;
            background-color: rgb(37, 99, 235);
            padding: 3px 6px;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="bg-gray-200">
    @include('header')

    <main class="w-full bg-gray-200 my-4">
        <div class="w-full bg-white py-4 px-8 mx-auto" style="max-width: 1300px">
            <h1 class="text-center text-4xl font-bold mb-32">Twój profil</h1>
            <div class="w-full">
                <div class="w-full py-4 border-b-2 border-gray-200">
                    @error('nick')
                        <div class="bg-red-400 border-red-600 border-2 p-4 mb-4">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    @if(session()->has('nickMessage'))
                        <section id="nickConfirm" class="w-full bg-green-400 border-2 border-green-600 pb-1 px-3 mb-4">
                            <button onclick='CloseMessage("nickConfirm")' class="text-2xl leading-8">x</button>
                            <span class="text-2xl leading-8 ml-20">{{session('nickMessage')}}</span>
                        </section>
                    @endif

                    <div class="flex flex-row">
                        <div class="w-1/4 text-2xl text-gray-400">
                            Nazwa użytkownika:
                        </div>
                        <div class="w-2/5 text-2xl">
                            {{Auth::user()->name}}
                        </div>
                        <div class="max-w-full text-2xl">
                            <button onclick='ChangeVisibility("nickForm")' class="formSubmit">Zmień nazwę użytkownika</button>
                        </div>
                    </div>

                    <div id="nickForm" class="w-full my-4" style="display: none">
                        <form method="post" action="konto/zmien/nick">
                            @csrf

                            <label class="text-xl">Nowa nazwa użytkownika:</label><br>
                            <input type="text" name="nick" required class="text-lg mb-2 formInput">

                            <input type="submit" value="Zmień" class="text-lg formSubmit">
                        </form>
                    </div>
                </div>
                <div class="w-full py-4 border-b-2 border-gray-200">
                    @error('email')
                        <div class="bg-red-400 border-red-600 border-2 p-4 mb-4">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    @if(session()->has('emailMessage'))
                        <section id="emailConfirm" class="w-full bg-green-400 border-2 border-green-600 pb-1 px-3 mb-4">
                            <button onclick='CloseMessage("emailConfirm")' class="text-2xl leading-8">x</button>
                            <span class="text-2xl leading-8 ml-20">{{session('emailMessage')}}</span>
                        </section>
                    @endif

                    <div class="flex flex-row">
                        <div class="w-1/4 text-2xl text-gray-400">
                            Email:
                        </div>
                        <div class="w-2/5 text-2xl">
                            {{Auth::user()->email}}
                        </div>
                        <div class="max-w-full text-2xl">
                            <button onclick='ChangeVisibility("emailForm")' class="formSubmit">Zmień email</button>
                        </div>
                    </div>

                    <div id="emailForm" class="w-full my-4" style="display: none">
                        <form method="post" action="konto/zmien/email">
                            @csrf

                            <label class="text-xl">Nowy email:</label><br>
                            <input type="email" name="email" required class="text-lg mb-2 formInput">

                            <input type="submit" value="Zmień" class="text-lg formSubmit">
                        </form>
                    </div>
                </div>
                <div class="w-full py-4">
                    @error('oldPassword')
                        <div class="bg-red-400 border-red-600 border-2 p-4 mb-4">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    @error('newPassword')
                        <div class="bg-red-400 border-red-600 border-2 p-4 mb-4">
                            <p>{{ $message }}</p>
                        </div>
                    @enderror

                    @if(session()->has('hasloMessage'))
                        <section id="hasloConfirm" class="w-full bg-green-400 border-2 border-green-600 pb-1 px-3 mb-4">
                            <button onclick='CloseMessage("hasloConfirm")' class="text-2xl leading-8">x</button>
                            <span class="text-2xl leading-8 ml-20">{{session('hasloMessage')}}</span>
                        </section>
                    @endif

                    <div class="flex flex-row">
                        <div class="w-1/4 text-2xl text-gray-400">
                            Hasło:
                        </div>
                        <div class="w-2/5 text-2xl"></div>
                        <div class="max-w-full text-2xl">
                            <button onclick='ChangeVisibility("passwordChangeForm")' class="formSubmit">Zmień hasło</button>
                        </div>
                    </div>

                    <div id="passwordChangeForm" class="w-full my-4" style="display: none">
                        <form method="post" action="konto/zmien/haslo">
                            @csrf

                            <label class="text-xl">Stare hasło:</label><br>
                            <input type="password" name="oldPassword" required class="text-lg mb-2 formInput"><br>

                            <label class="text-xl">Nowe hasło:</label><br>
                            <input type="password" name="newPassword" required class="text-lg mb-2 formInput"><br>

                            <input type="submit" value="Zmień" class="text-lg formSubmit">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(Session::has('registered'))
            {{Session::forget('registered')}}
            @include('registerConfirm')
        @endif
    </main>

    <script>
        function ChangeVisibility(targetElementId)
        {
            var targetElement = document.getElementById(targetElementId);

            if(targetElement.style.display == "block")
                targetElement.style.display = "none";
            else
                targetElement.style.display = "block";
        }

        function CloseMessage(targetElementId)
        {
            document.getElementById(targetElementId).style.display = "none";
        }
    </script>
    @livewireScripts
</body>
</html>
