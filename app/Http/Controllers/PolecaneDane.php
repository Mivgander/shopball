<?php

namespace App\Http\Controllers;

class PolecaneDane
{
    function __construct($kategoriaURL, $query)
    {
        $this->kategoriaURL = $kategoriaURL;
        $this->query = $query;
    }
}

?>
