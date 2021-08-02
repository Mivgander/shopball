<main class="w-full bg-gray-200 my-4">
    <div class="main-parent w-full mx-auto bg-gray-200 my-10">
        <h1 class="text-5xl uppercase">{{$tytul}}
            @if(count($produkty) > 0)
                <span class="text-4xl">({{$produkty->total()}})</span>
            @endif
        </h1>
    </div>

    <div class="main-parent relative w-full mx-auto flex flex-row items-start">
        <div class="absolute top-0 left-0 w-full h-full z-10" wire:loading style="background-color: rgba(100, 100, 100, 0.5)"></div>

        <div class="mr-4 p-6 bg-white" style="width: 310px;">
            <div class="block">
                <h1 class="text-3xl">Filtry</h1><br>
                <a wire:click="FiltryReset" class="text-xl px-4 py-2 cursor-pointer font-bold bg-blue-600 hover:bg-blue-500">Wyczyść filtry</a>
            </div>
            <div class="mt-14">
                <div class="mt-8">
                    <h2 class="text-2xl">Cena</h2>
                    <div class="mt-4 flex flex-row justify-center">
                        <input type="number" wire:model.debounce.500ms="od" placeholder="od" min="0" @if($request['od'] != '') value="{{$request['od']}}" @endif  class="border-2 border-gray-400 outline-none w-1/3 text-sm p-1 hover:border-gray-700 focus:border-gray-700">
                        &#160&#160-&#160&#160
                        <input type="number" wire:model.debounce.500ms="do" placeholder="do" min="0" @if($request['do'] != '') value="{{$request['do']}}" @endif class="border-2 border-gray-400 outline-none w-1/3 text-sm p-1 hover:border-gray-700 focus:border-gray-700">
                    </div>
                </div>

                @foreach($filtry as $filtr)
                    <div class="mt-8">
                        <h2 class="text-2xl">{{str_replace('_', ' ', mb_strtoupper(mb_substr($filtr->nazwa, 0, 1)) . mb_substr($filtr->nazwa, 1));}}</h2>
                        <div class="mt-4">
                            @if(count($filtr->query) > 4)
                                <?php $x = 0; ?>
                                @foreach($filtr->query as $query)
                                    @if($x == 4)
                                        <span class="more-button cursor-pointer text-lg text-blue-600">Pokaż więcej</span>
                                        <div style="display: none;" class="more-inputs">
                                    @endif
                                    <label class="filtr-box">
                                        <input class="filtr-input" type="checkbox" wire:model="{{$filtr->nazwa}}" value="{{$query['param']}}" <?php if(!in_array($query['param'], $request[$filtr->nazwa]) && $query['ile'] == 0) echo 'disabled'; ?>>
                                        <span class="filtr-nazwa text-xl">{{$query['param']}}</span> <span class="filtr-numer text-base">({{$query['ile']}})</span>
                                        <span class="checkmark"></span>
                                    </label>
                                    <?php $x++; ?>
                                @endforeach
                                </div>
                                <span style="display: none;" class="less-button cursor-pointer text-lg text-blue-600">Pokaż mniej</span>
                            @else
                                @foreach($filtr->query as $query)
                                    <label class="filtr-box">
                                        <input class="filtr-input" type="checkbox" wire:model="{{$filtr->nazwa}}" value="{{$query['param']}}" <?php if(!in_array($query['param'], $request[$filtr->nazwa]) && $query['ile'] == 0) echo 'disabled'; ?>>
                                        <span class="filtr-nazwa text-xl">{{$query['param']}}</span> <span class="filtr-numer text-base">({{$query['ile']}})</span>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(count($produkty) > 0)
            <div class="w-3/4 bg-white p-2 relative">
                <div class="mt-6 mb-4 mx-3">
                    {{$produkty->links()}}
                </div>

                <?php $a = 0; ?>
                @foreach($produkty as $produkt)
                    <div class="mx-3 p-3 bg-white flex flex-row flex-wrap border-b-2 border-gray-200">
                        <a href="{{ asset('/produkt/'.$nazwa.'/'.$produkt->id) }}" class="mr-5 cursor-pointer" style="width: 150px; height: 150px;">
                            <img src="{{ asset('images/'.$produkt->zdjecie) }}" style="max-height: 150px; max-width: 150px" class="mx-auto">
                        </a>
                        <div style="width: calc(100% - 180px)">
                            <a href="{{ asset('/produkt/'.$nazwa.'/'.$produkt->id) }}" class="hover:underline cursor-pointer">
                                <h2 class="text-xl">{{$produkt->tytul}}</h2>
                            </a>
                            <p class="text-sm">
                                <?php $b = 0; ?>
                                @foreach($filtry as $filtr)
                                    <span class="text-gray-500">{{str_replace('_', ' ', $filtr->nazwa)}}:</span> {{$parametry[$b][$a]}}&#160&#160
                                    <?php $b++; ?>
                                @endforeach
                            </p>
                            <h1 class="text-3xl font-bold">{{number_format($produkt->cena, 2, ',', ' ')}} zł</h1>
                            @if(Auth::check())
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
        @else
        <div class="w-3/4 text-2xl font-bold text-center mt-10">
            Przepraszamy, ale nie znaleźliśmy takich produktów
        </div>
        @endif
    </div>

    @if(Session::has('registered'))
        {{Session::forget('registered')}}
        @include('registerConfirm')
    @endif

    <script>
        var btns = document.getElementsByClassName("koszyk");

        for(let i=0; i<btns.length; i++)
        {
            btns[i].addEventListener('click', event => {
                window.location = '/koszyk/dodaj/' + btns[i].dataset.kategoria + '/' + btns[i].dataset.id;
            });
        }
        console.log(window.location);
    </script>
    <script>
        var moreButton = document.getElementsByClassName('more-button');
        var lessButton = document.getElementsByClassName('less-button');
        var moreInputs = document.getElementsByClassName('more-inputs');

        for(let i=0; i<moreButton.length; i++)
        {
            moreButton[i].addEventListener('click', function(){
                moreInputs[i].style.display = "block";
                lessButton[i].style.display = "initial";
                moreButton[i].style.display = "none";
            });

            lessButton[i].addEventListener('click', function(){
                moreInputs[i].style.display = "none";
                lessButton[i].style.display = "none";
                moreButton[i].style.display = "initial";
            });
        }

        var filtrinput = document.getElementsByClassName('filtr-input');
        var box = document.getElementsByClassName('filtr-box');
        var nazwa = document.getElementsByClassName('filtr-nazwa');
        var numer = document.getElementsByClassName('filtr-numer');
        var checkmark = document.getElementsByClassName('checkmark');

        function FiltrCheck()
        {
            for(let i=0; i<filtrinput.length; i++)
            {
                if(filtrinput[i].disabled == true)
                {
                    box[i].classList.add('diasabled-box');
                    nazwa[i].classList.add('disabled-text');
                    numer[i].classList.add('disabled-text');
                    checkmark[i].classList.add('disabled-checkmark');
                }
                else
                {
                    box[i].classList.remove('diasabled-box');
                    nazwa[i].classList.remove('disabled-text');
                    numer[i].classList.remove('disabled-text');
                    checkmark[i].classList.remove('disabled-checkmark');
                }
            }
        }

        window.onload = FiltrCheck();

        document.addEventListener('DOMContentLoaded', () => {
            Livewire.hook('element.updated', (el, component) => {
                FiltrCheck();
            });
        });
    </script>
</main>
