<section id="registerConfirm" class="w-full fixed z-10 bottom-0 left-0 bg-green-400 border-t-2 border-green-600 pb-1 px-3">
    <button onclick="registerClose()" class="text-2xl leading-8">x</button>
    <span class="text-2xl leading-8 ml-20">Rejestracja przebiegła pomyślnie! Możesz się teraz zalogować.</span>
</section>
<script>
    function registerClose()
    {
        console.log('howaj');
        document.getElementById('registerConfirm').style.display = "none";
    }
</script>
