<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use Illuminate\Http\Request;

class sectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $request->validate([
        //     'searchtype'=>'required|alpha',
        // ]);
        if ($request->searchtype=='name'){
            $colmn = 'section';
            $sections = Sections::where($colmn, 'Like', "%{$request->search}%")
                                ->get();
        }elseif($request->searchtype=='id'){
            $colmn = 'id';
            $sections = Sections::where($colmn, 'Like', "%{$request->search}%")
                                ->get();
        }else{
            $sections = Sections::all();
        }
            
            return view('sections.sectionsgrid', compact('sections')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.newsection');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'section'=>'required|min:3',
        ]);
        $result=Sections::insert($data);
        return redirect()->route('section.index')->with('status', 'New Section Sucessfuly Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {   
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = Sections::findorfail($id);
        return view('sections.editsection', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'section'=>'required|min:3',
        ]);
        Sections::where('id',$id)
                    ->update(['section'=>$request->section]);
        return redirect()->route('section.index')->with('status', 'Section/Department Updated Sucessfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
