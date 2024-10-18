<?php

namespace App\Http\Controllers;

use App\Models\addressee;
use App\Models\designations;
use App\Models\letter;
use App\Models\lettersHistory;
use App\Models\sender;
use App\Models\tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



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
        
        date_default_timezone_set('Asia/Karachi');
        
        // inserting data to sender table
        $sender_id = sender::insertGetId($sender_data);
        // insertingdata to letter table
        
        if ($request->hasFile('scan_file')){
            $path = $request->scan_file->store('images', 'public');
        }else{
            $path = null;
        }
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
        $tracking_obj->letter_id = $letter_id;
        $tracking_obj->marked_to = $request->addressee_id;
        $tracking_obj->send_by = Auth::id();
        $tracking_obj->sent_to= null;
        $tracking_obj->received_on = null;
        $tracking_obj->tracking_status_id = 4;
        $tracking_obj->save();
        return redirect()->route('lettersgrid')->with('status', 'New Letter Saved Successfully');
    }
    public function edit(Request $request){
        //sanitizing id
        $id = filter_var($request->id, FILTER_SANITIZE_NUMBER_INT); 
        
        $letters = letter::where('letters.id', '=', $id)
        ->join('addressees', 'addressees.id', '=', 'letters.addressee_id')
        ->join('senders', 'senders.id', '=', 'letters.sender_id')
        ->join('designations', 'designations.id', '=', 'addressees.designation_id')
        ->get(['letters.id as l_id',
            'letters.letter_no',
            'letters.letter_date',
            'letters.dispatch_no',
            'letters.dispatch_date',
            'letters.subject',
            'letters.remarks',
            'letters.scan_path',
            'senders.id as s_id',
            'senders.sender_name',
            'senders.sender_designation',
            'senders.sender_address',
            'addressees.id as a_id',
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
    public function update(Request $request, string $id){
        //sanitizing id
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT); 
        //validating data
        $request->validate([
            'sender_id'=>'required|numeric',
            'sender_name'=>'required|string',
            'sender_designation'=>'required|string',
            'sender_address'=>'required|string',
        ]);
        //since sender is seprate table thus updating sepretly
        sender::where('id', '=', $request->sender_id)
                ->update([
                    'sender_name'=>$request->sender_name,
                    'sender_designation'=>$request->sender_designation,
                    'sender_address'=>$request->sender_address,
                ]);
        //updating letters
        $letter = letter::findorfail($id);
        $scan_document_updated = false;
        if ($request->hasFile('scan_file')){
            $path = public_path('storage/'). $letter->scan_path;
            $scan_document_updated = true;
            if(File::exists($path)){
                File::delete($path);
            }
            $path = $request->scan_file->store('images', 'public');
            $letter->scan_path=$path;
        }

        $changes_array = array();
        //tracking changes
        if ($letter->addressee_id != $request->addressee_id){
            $changes_array['addressed_id'] = array($letter->addressee_id, $request->addressee_id);
        }
        if($letter->letter_no!=$request->letter_no){
            $changes_array['Letter No']  = array($letter->letter_no,$request->letter_no);
        }
        if($letter->letter_date!=$request->letter_date){
            $changes_array['Letter Date']=array($letter->letter_date, $request->letter_date);
        }
        if($letter->subject!=$request->subject){
            $changes_array['Subject']=array($letter->subject, $request->subject);
        }
        if($letter->dispatch_no!=$request->dispatch_no){
            $changes_array['Dispatch No']=array($letter->dispatch_no, $request->dispatch_no);
        }
        if($letter->dispatch_date!=$request->dispatch_date){
            $changes_array['Dispatch Date']=array($letter->dispatch_date,$request->dispatch_date);
        }
        if($letter->remarks!=$request->remarks){
            $changes_array['Remarks']=array($letter->remarks,$request->remarks);
        }
        //updating letters table
        $letter->addressee_id = $request->addressee_id;
        $letter->letter_no=$request->letter_no;
        $letter->letter_date=$request->letter_date;
        $letter->subject=$request->subject;
        $letter->dispatch_no=$request->dispatch_no;
        $letter->dispatch_date=$request->dispatch_date;
        $letter->remarks=$request->remarks;
        $letter->save();
        
        
        date_default_timezone_set('Asia/Karachi');
        
        //create letters history records
        foreach ($changes_array as $column => $changes) {
            $record = [
                'letter_id'=>$id,
                'user_id'=>Auth::id(),
                'column_name'=>$column,
                'from'=>$changes[0],
                'to'=>$changes[1],
                'created_at'=>date('Y-m-d H:i:s'),
            ];
            lettersHistory::create($record);
          }

          //if scan file is updated then histor aslo needs to beupdated

          if ($scan_document_updated){
            $record = [
                'letter_id'=>$id,
                'user_id'=>Auth::id(),
                'column_name'=>'Scaned Document',
                'from'=>$changes[0],
                'to'=>$changes[1],
                'created_at'=>date('Y-m-d H:i:s'),
            ];
            lettersHistory::create($record);
          }
          
          return redirect()->route('lettersgrid')->with('status', 'Letter Successfully Updated');
    }
    
}       
