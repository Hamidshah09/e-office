<?php

namespace App\Http\Controllers;

use App\Models\addressee;
use App\Models\designations;
use App\Models\letter;
use Illuminate\Http\Request;

class letterController extends Controller
{
    public function index(){
        $designations = designations::all();
        return view('newletter', compact('designations'));

    }
    
}
