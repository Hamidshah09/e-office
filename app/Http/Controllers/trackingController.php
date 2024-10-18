<?php

namespace App\Http\Controllers;

use App\Models\addressee;
use App\Models\designations;
use App\Models\files;
use App\Models\letter;
use App\Models\tracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class trackingController extends Controller
{
    
    public function validate_incoming($request){
        if ($request->search){
            $request->validate([
                'search'=>'string',
                'searchtype'=>'required|string',
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
        }elseif($request->searchtype=='marked_to'){
            $colmn = 'addressees.addressee_name';
        }elseif($request->searchtype=='send_by'){
            $colmn = 'users.name';
        }elseif($request->searchtype==null){
            $colmn = 'letters.id';
        }else{
            abort(403, "Invalid arguments");
        }
        return $colmn;
    }
    public function inbox(Request $request){
        
        $officers = addressee::join('designations', 'designations.id', '=', 'addressees.designation_id')
                                    ->where('addressees.status_id', '=', '1')
                                    ->get(['addressees.id', 'addressees.addressee_name', 'designations.designation']);
        $files = files::where('author_id', '=', Auth::id())->get();
        $colmn = $this->validate_incoming($request);
        $tracking_data = tracking::whereNotIn('trackings.letter_id', function ($query) {
                                    $query->select('letter_id')->from('trackings')->where('send_by', Auth::id());
                                    })
                                    ->where($colmn, 'like', "%{$request->search}%")
                                    ->where('sent_to', '=', Auth::id())
                                    ->where('tracking_status_id', '=', 2)
                                    ->join('letters', 'letters.id', '=', 'trackings.letter_id')
                                    ->join('addressees', 'addressees.id', '=', 'trackings.marked_to')
                                    ->leftjoin('users', 'users.id','=', 'trackings.send_by')
                                    ->join('tracking_statuses', 'tracking_statuses.id','=', 'trackings.tracking_status_id')
                                    ->get([
                                        'letters.id',
                                        'letters.letter_no',
                                        'letters.letter_date',
                                        'letters.subject',
                                        'addressees.addressee_name',
                                        'users.name',
                                        'trackings.sent_on',
                                        'tracking_statuses.tracking_status',
                                    ]);
        $title = 'Inbox';
        return view('trackings.inbox', compact('tracking_data', 'title', 'officers', 'files'));
        
    }
    public function sending(Request $request){
        $colmn = $this->validate_incoming($request);
        $users = User::all();
        $tracking_data = tracking::where('trackings.send_by', '=', Auth::id())
            ->where($colmn, 'like', "%{$request->search}%")
            ->whereNull('trackings.sent_to')
            ->where('trackings.tracking_status_id', '=', 4)
            ->join('letters', 'letters.id', '=', 'trackings.letter_id')
            ->join('addressees', 'addressees.id', '=', 'trackings.marked_to')
            ->leftjoin('users as pa', 'pa.id','=', 'addressees.user_id')
            ->leftjoin('users', 'users.id','=', 'trackings.send_by')
            ->join('tracking_statuses', 'tracking_statuses.id','=', 'trackings.tracking_status_id')
            ->get([
                'trackings.id',
                'letters.letter_no',
                'letters.letter_date',
                'letters.subject',
                'addressees.addressee_name',
                'pa.name',
                'pa.id as pa_id',
                'trackings.sent_on',
                'tracking_statuses.tracking_status',
            ]);
        $title = 'Ready for Sending';
        $letter_ids = array();
        foreach($tracking_data as $key =>$value){
            array_push($letter_ids, $value->id);
        }
        session(['tracking_data'=>$letter_ids]);
        return view('trackings.readyforsending', compact('tracking_data', 'title',  'users'));

    }
    public function outbox(Request $request){
        $colmn = $this->validate_incoming($request);
        $officers = addressee::where('status_id', '=', '1')->get();
        $designations = addressee::join('designations', 'designations.id', '=', 'addressees.designation_id')
                                    ->where('addressees.status_id', '=', '1')
                                    ->get(['designations.id', 'designations.designation']);
        $tracking_data = tracking::where($colmn, 'like', "%{$request->search}%")
            ->where('sent_to', '=', Auth::id())
            ->where('tracking_status_id', '=', 1)
            ->join('letters', 'letters.id', '=', 'trackings.letter_id')
            ->join('addressees', 'addressees.id', '=', 'trackings.marked_to')
            ->leftjoin('users', 'users.id','=', 'trackings.send_by')
            ->join('tracking_statuses', 'tracking_statuses.id','=', 'trackings.tracking_status_id')
            ->get([
                'trackings.id',
                'letters.letter_no',
                'letters.letter_date',
                'letters.subject',
                'addressees.addressee_name',
                'users.name',
                'trackings.sent_on',
                'tracking_statuses.tracking_status',
            ]);
        $title = 'Outbox';
        return view('trackings.outbox', compact('tracking_data', 'title', 'designations', 'officers'));
        
    }
    public function receive(Request $request){
        foreach($request->all() as $key => $value){
            if (substr($key, 0,3)=='chk'){
                $id = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                tracking::where('id', '=', $id)
                        ->update([
                        'received_on'=> now(),
                        'tracking_status_id'=>'2',
                ]);
            }
        };
        return redirect()->route('inbox')->with('status', 'Letters Received and now in inbox');
    }
    public function sentitems(Request $request){
        
        $colmn = $this->validate_incoming($request);
        $tracking_data = tracking::where($colmn, 'like', "%{$request->search}%")
            ->where('send_by', '=', Auth::id())
            ->where('tracking_status_id', '=', '1')
            ->whereNull('received_on')
            ->join('letters', 'letters.id', '=', 'trackings.letter_id')
            ->join('addressees', 'addressees.id', '=', 'trackings.marked_to')
            ->leftjoin('users', 'users.id','=', 'trackings.send_by')
            ->join('tracking_statuses', 'tracking_statuses.id','=', 'trackings.tracking_status_id')
            ->get([
                'trackings.id',
                'letters.letter_no',
                'letters.letter_date',
                'letters.subject',
                'addressees.addressee_name',
                'users.name',
                'trackings.sent_on',
                'tracking_statuses.tracking_status',
            ]);
        $letter_ids = array();
        foreach($tracking_data as $key =>$value){
            array_push($letter_ids, $value->id);
        }
        session(['tracking_data'=>$letter_ids]);
        $title = 'Sent Letters';
        return view('trackings.sentitems', compact('tracking_data', 'title'));
        
    }
    public function recall(Request $request){
        if ($request->request_type=='Return'){
            foreach($request->all() as $key => $value){
                if (substr($key, 0,3)=='chk'){
                    $id = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    $letter_ids= session('tracking_data');
                    if (in_array($id, $letter_ids)){
                        tracking::where('id', '=', $id)
                                ->update([
                                'sent_to'=> null,
                                'tracking_status_id'=>'4',
                        ]);
                    }
                }
            }
            return redirect()->route('inbox')->with('status', 'Letters is recalled and now is at Ready for Sending');
        }else{
            foreach($request->all() as $key => $value){
                if (substr($key, 0,3)=='chk'){
                    $id = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    $letter_ids= session('tracking_data');
                    if (in_array($id, $letter_ids)){
                        $record = tracking::find($id);
                        $record->delete();
                    }
                }
            }
            return redirect()->route('inbox')->with('status', 'Letters is recalled and now in inbox');
        }
        
    }
    public function send_concerned(Request $request){
        foreach($request->all() as $key => $value){
            if (substr($key, 0,3)=='chk'){
                $id = filter_var(substr($key, 3), FILTER_SANITIZE_NUMBER_INT);
                
                $letter_ids= session('tracking_data');
                if (in_array($id, $letter_ids)){
                    tracking::where('id', '=', $id)
                                ->update([
                                'send_by'=>Auth::id(),
                                'sent_on'=> now(),
                                'sent_to'=> $value,
                                'tracking_status_id'=>'1',
                    ]);//tracing
                }//if
                 
            }//for each
        };
        
        return redirect()->route('sending')->with('status', 'Letters Sent to Concerned Officials');
    
    }
    public function marked_to($request){
        
        foreach($request->all() as $key => $value){
            if (substr($key, 0,3)=='chk'){
                $id = filter_var(substr($key, 3), FILTER_SANITIZE_NUMBER_INT);
                
                $oid = tracking::join('letters', 'letters.id', '=', 'trackings.letter_id')
                                ->where('letters.id', '=', $id)
                                ->orderBy('trackings.id', 'DESC')
                                ->get();
                foreach($oid as $row){
                    $previous_marked_to = $row['addressee_id'];
                }
                $err = false;
                if ($previous_marked_to==$value){
                    $err = true;
                }else{
                    tracking::insert([
                            'letter_id'=>$id,
                            'marked_to'=>$value,
                            'send_by'=>Auth::id(),
                            'sent_on'=> null,
                            'tracking_status_id'=>'4',
                    ]);
                }
            }
            if ($err){
                return redirect()->route('inbox')->with('status', 'Some letters marked to same officers');
            }else{
                return redirect()->route('inbox')->with('status', 'Marking updated');
            }
    
        }
    }
    public function setfile($request){
        foreach($request->all() as $key => $value){
            if (substr($key, 0,3)=='chk'){
                $id = filter_var(substr($key, 3), FILTER_SANITIZE_NUMBER_INT);
                $corispondance_id = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    $letter = letter::findorfail($id);
                    $letter->c_id = $corispondance_id;
                    $letter->tracking_status_id='5';
                    $letter->save();
                }
        }
    }
    public function inboxupdate(Request $request){
        if ($request->form_type=='marked_to'){
            $this->marked_to($request);
        }else{
            $this->setfile($request);
            return redirect()->route('inbox')->with('status', 'Letter(s) Placed in File(s)');
        }
    }

}