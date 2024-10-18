<?php

namespace App\Http\Controllers;

use App\Models\files;
use App\Http\Requests\StorefilesRequest;
use App\Http\Requests\UpdatefilesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $user_id = Auth::id();
        $files = files::join('users', 'users.id', '=', 'author_id')
                        ->orderBy('files.id', 'DESC')
                        ->get(['files.id',  'files.file_no','files.file_subject', 'files.author_id','users.name', 'files.created_at']);
        
                        return view('files.filesgrid', compact('files',  'user_id'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('files.newfile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'file_no'=>'required|string|max:255',
            'file_subject'=>'required|string|max:255'
        ]);
        files::insert([
            'file_no'=> $request->file_no,
            'file_subject'=> $request->file_subject,
            'author_id'=> Auth::id(),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        // $files = new files();
        // $files->file_no = $request->file_no;
        // $files->file_subject = $request->file_subject;
        // $files->author_id = Auth::id();
        // $files->created_at = now();
        // $files->updated_at = now();
        // $id = $files->save;
        // return 'success';
        return redirect()->route('files.index')->with('status', 'New File Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(files $files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefilesRequest $request, files $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(files $files)
    {
        //
    }
}
