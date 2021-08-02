<!DOCTYPE html>
<html lang="PL-pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szukaj - SHOPBALL</title>

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

        .diasabled-box
        {
            cursor: default !important;
        }

        .disabled-text
        {
            color: #bbb !important;
            text-decoration: none !important;
        }

        .disabled-checkmark
        {
            background-color: transparent !important;
        }

        /* Checkbox */


    </style>
</head>
<body class="bg-gray-200">
    @include('header')
    @livewire('szukaj-filtruj-produkty', ['szukanaKategoria' => $szukanaKategoria, 'szukanyTekst' => $szukanyTekst])
    @livewireScripts
</body>
</html>
