<?php

namespace App\Http\Controllers;

use App\Models\test;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function index(){
        return view('letters.test');

    }
    public function update(Request $request){
        $data=$request->validate([
            'test_col'=>'required|string',
        ]);
        $id = test::insertGetId($data);
        return $id;
    }
}
