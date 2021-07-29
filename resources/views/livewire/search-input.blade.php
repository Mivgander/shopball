<div class="w-full flex relative">
    <input required autocomplete="off" wire:model="search" type="text" placeholder="Szukaj..." name="q" id="search-input" class="text-xl p-2 w-full">
    <div id="search-result">
        @if($produkty != [])
            <div class="absolute left-0 w-full bg-white flex flex-col" style="top: 46px; border: 1px solid gray; border-top: none;">
            <div class="px-3 py-1 text-lg"><span>Produkty</span></div>
                @if(count($produkty) >= 6)
                    @for($i=0; $i<6; $i++)
                        <a href="{{ url('/produkt/'.$produkty[$i]->kategoriaURL.'/'.$produkty[$i]->query->id) }}" class="flex items-center text-base px-3 py-1 cursor-pointer hover:bg-gray-300">
                            <img src="{{ asset('images/'.$produkty[$i]->query->zdjecie) }}" style="max-width: 40px; max-height: 40px;">
                            <div class="w-full pl-3">
                                {{ $produkty[$i]->query->tytul }}
                            </div>
                        </a>
                    @endfor
                @else
                    @foreach($produkty as $produkt)
                        <a href="{{ url('/produkt/'.$produkt->kategoriaURL.'/'.$produkt->query->id) }}" class="flex items-center text-base px-3 py-1 cursor-pointer hover:bg-gray-300">
                            <img src="{{ asset('images/'.$produkt->query->zdjecie) }}" style="max-width: 40px; max-height: 40px;">
                            <div class="w-full pl-3">
                                {{ $produkt->query->tytul }}
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        @endif
    </div>

    <select wire:model="select" name="kategoria" class="outline-none">
        <option value="wszedzie">Wszędzie</option>
        <option value="pilka_nozna">Piłka nożna</option>
        <option value="pilka_reczna">Piłka ręczna</option>
        <option value="siatkowka">Siatkówka</option>
        <option value="koszykowka">Koszykówka</option>
        <option value="tenis_ziemny">Tenis ziemny</option>
        <option value="tenis_stolowy">Tenis stołowy</option>
    </select>

    <script>
        const input = document.getElementById('search-input');
        const result = document.getElementById('search-result');

        document.addEventListener('click', function(event){
            if(event.target == input || event.target == result)
            {
                result.style.display = "block";
            }
            else
            {
                result.style.display = "none";
            }
        });
    </script>
</div>
