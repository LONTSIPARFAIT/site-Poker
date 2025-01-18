<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolitiqueController extends Controller
{
    public function index()
    {
        return view('politique');
    }
}
