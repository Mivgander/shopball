<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    function index(Request $request)
    {
        $request->file('file')->store('docs');
        return $request->file('file')->hashName();
    }
}
