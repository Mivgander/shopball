<?php
namespace App\Http\Livewire;

class FiltryDane
{
    function __construct($nazwa, $query)
    {
        $this->nazwa = $nazwa;
        $this->query = $query;
    }
}
?>
