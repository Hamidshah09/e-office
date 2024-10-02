<?php

namespace App\Http\Controllers;

use App\Models\addressee;
use App\Models\designations;
use App\Models\letter;
use App\Models\sender;
use App\Models\tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class letterController extends Controller
{
    public function index(Request $request){
        
    
        if ($request->search){
            $request->validate([
                'search'=>'string',
                'searchtype'=>'required|alpha',
            ]); 
        }
        if ($request->searchtype=='id'){
            $colmn = 'letters.id';
        }elseif($request->searchtype=='letter_no'){
            $colmn = 'letters.letter_no';
        }elseif($request->searchtype=='letter_date'){
            $colmn = 'letters.letter_date';
        }elseif($request->searchtype=='dispatch_no'){
            $colmn = 'letters.dispatch_no';
        }elseif($request->searchtype=='dispatch_date'){
            $colmn = 'letters.dispatch_date';
        }elseif($request->searchtype=='subject'){
            $colmn = 'letters.subject';
        }elseif($request->searchtype==null){
            $colmn = 'letters.id';
        }else{
            abort(403, "Invalid arguments");
        }
        $letters = letter::where($colmn, 'like', "%{$request->search}%")
                            ->join('addressees', 'addressees.id', '=', 'letters.addressee_id')
                            ->join('designations', 'designations.id', '=', 'addressees.designation_id')
                            ->get(['letters.id',
                                'letters.letter_no',
                                'letters.letter_date',
                                'letters.dispatch_no',
                                'letters.dispatch_date',
                                'letters.subject',
                                'designations.designation',
                            ]);
        
     return view('letters.lettersgrid', compact('letters'));   

    }

    public function create(){
        $designations = designations::all();
        $officers = addressee::all();
        return view('letters.newletter', compact('designations', 'officers'));
    }

    public function store(Request $request){
        $sender_data = $request->validate([
            'sender_name'=>'required|string|max:255',
            'sender_designation'=>'required|string|max:255',
            'sender_address'=>'required|string|max:255',
        ]);
        $validated_letter = $request->validate([
            'addressee_id'=>'required|numeric',
            'letter_no'=>'required|string|max:255',
            'letter_date'=>'required|date',
            'subject'=>'required|string|max:255',
            'dispatch_no'=>'required|string|max:255',
            'dispatch_date'=>'required|date',
            'remarks'=>'string',
            'scan_file'=>'max:3000'
        ]);
        

        if ($request->scan_file){
            $path = $request->scan_file->store('images', 'public');
        }else{
            $path = null;
        }
        // inserting data to sender table
        $sender_id = sender::insert($sender_data);
        // insertingdata to letter table
        $letter_obj = new letter();
        $letter_obj->letter_no = $request->letter_no;
        $letter_obj->letter_date = $request->letter_date;
        $letter_obj->subject = $request->subject;
        $letter_obj->dispatch_no = $request->dispatch_no;
        $letter_obj->dispatch_date = $request->dispatch_date;
        $letter_obj->sender_id = $sender_id;
        $letter_obj->addressee_id = $request->addressee_id;
        $letter_obj->remarks = $request->remarks;
        $letter_obj->scan_path = $path;
        $letter_obj->save();
        $letter_id = $letter_obj->id;
        // inserting data to tracking data

        $tracking_obj = new tracking();

    }
    public function edit(Request $request){
        $id = filter_var($request->id, FILTER_SANITIZE_NUMBER_INT); 
        $letters = letter::where('letters.id', '=', $id)
        ->join('addressees', 'addressees.id', '=', 'letters.addressee_id')
        ->join('senders', 'senders.id', '=', 'letters.sender_id')
        ->join('designations', 'designations.id', '=', 'addressees.designation_id')
        ->get(['letters.id',
            'letters.letter_no',
            'letters.letter_date',
            'letters.dispatch_no',
            'letters.dispatch_date',
            'letters.subject',
            'letters.remarks',
            'senders.id',
            'senders.sender_name',
            'senders.sender_designation',
            'senders.sender_address',
            'addressees.id',
            'addressees.addressee_name',
            'addressees.designation_id',
        ]);
        $designations = designations::all();
        $officers = addressee::all();
        foreach($letters as $let){
            $letter = $let;
        }
        
        return view('letters.editletter', compact('letter', 'designations', 'officers'));   
    }
}
