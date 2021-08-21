<div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    @if(count($errors) > 0)
        <div class="bg-red-400 border-red-600 border-2 p-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="list-disc ml-3">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="Dodaj" method="post" enctype="multipart/form-data">
        <hr class="border-t-2 border-gray-200">
        <div class="my-4">
            <h1 class="text-2xl">Podstawowe informacje</h1>
        </div>
        <div class="my-6">
            <label class="font-bold text-lg">Marka:</label><br>
            <input class="loginInput" type="text" wire:model="marka" required autocomplete="off" placeholder="Podaj markę...">
        </div>
        <div class="my-6">
            <label class="font-bold text-lg">Nazwa produktu:</label><br>
            <input class="loginInput" type="text" wire:model="nazwa" required autocomplete="off" placeholder="Podaj nazwę...">
        </div>
        <div class="my-6">
            <label class="font-bold text-lg">Podaj opis produktu:</label><br>
            <x-input.tinymce wire:model="opis" placeholder="Podaj opis..." />
        </div>
        <div class="my-6">
            <label class="font-bold text-lg">Cena:</label><br>
            <input class="loginInput" type="number" wire:model="cena" min="0.01" step="0.01" required autocomplete="off" placeholder="Podaj cenę...">
        </div>
        <div class="my-6">
            <label class="font-bold text-lg">Dodaj zdjęcie:</label><br>
            <input type="file" wire:model="zdjecie" readonly required accept="image/png, image/jpeg">
        </div>

        <div class="my-6">
            <label class="font-bold text-lg">Wybierz kategorię produktu:</label>
            <select class="outline-none p-1" wire:model="kategoria">
                <option value="Wybierz kategorię" selected disabled hidden>Wybierz kategorię</option>
                <option value="pilka_nozna">Piłka nożna</option>
                <option value="pilka_reczna">Piłka ręczna</option>
                <option value="siatkowka">Siatkówka</option>
                <option value="koszykowka">Koszykówka</option>
                <option value="tenis_ziemny">Tenis ziemny</option>
                <option value="tenis_stolowy">Tenis stołowy</option>
            </select>
        </div>

        {!! $kontent !!}

        <div class="my-6">
            <button type="submit" class="loginSubmit">Dodaj produkt</button>
        </div>
    </form>
</div>
