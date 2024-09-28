<?php

namespace App\Http\Controllers;

use App\Models\addressee;
use App\Models\designations;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index(){
        $designations = designations::all();
        $officers = addressee::join('designations', 'designations.id', '=', 'addressees.designation_id')
                                ->join('statuses', 'statuses.id', '=', 'addressees.status_id')
                                ->get(['addressees.id', 'addressees.addressee_name', 'designations.designation','statuses.status']);
        // return $officers;                        
        return view('officer.officersgrid', ['officers'=>$officers, 'designations'=>$designations,]);
    }
    public function newofficer(){
        $designations = designations::all();
        return view('officer.newofficer', compact('designations'));

    }

    public function savenewofficer(Request $request){
        $data = $request->validate([
            'addressee_name'=>'required|min:5',
            'designation_id'=>'required|numeric',
            'status_id'=>'required|numeric',
        ]);
        $result = addressee::create($data);
        if ($result){
            $msg='New Officer Successfully Added';
            $type='Success';
        }else{
            $msg='There were some error';
            $type='danger';
        }
        return redirect()->route('officersGrid')->with('status', 'New Applicant added successfully Added');

    }

    public function search(Request $request){
        $request->validate([
            'searchtype'=>'required|alpha',
        ]);
        
        $designations = designations::all();
        if ($request->searchtype=='name'){
            $colmn = 'addressees.addressee_name';
        }elseif($request->searchtype=='id'){
            $colmn = 'addressees.id';
        }elseif($request->searchtype=='designation'){
            $colmn = 'designations.designation';
        }elseif($request->searchtype=='status'){
            $colmn = 'statuses.status';
        }else{
            abort(403, "Invalid arguments");
        }
        $officers = addressee::where($colmn, 'Like', "%{$request->search}%")
                                ->join('designations', 'designations.id', '=', 'addressees.designation_id')
                                ->join('statuses', 'statuses.id', '=', 'addressees.status_id')
                                ->get(['addressees.id', 'addressees.addressee_name', 'designations.designation','statuses.status']);
        return view('officer.officersgrid', compact('officers', 'designations'));

    }
    public function edit(Request $request, string $id){
        // $id = $request->validate([
        //     $request->id=>'required|numeric'
        // ]);
        $designations = designations::all();
        $officer = addressee::findorfail($id);
        return view('officer.editofficer', compact(['officer', 'designations']));
    }

    public function updateofficer(Request $request, string $id){
        $request->validate([
            'addressee_name'=>'required|min:5',
            'designation_id'=>'required|numeric',
            'status_id'=>'required|numeric',
        ]);
        
        addressee::where('id',$id)
                    ->update([
                        'addressee_name'=>$request->addressee_name,
            'designation_id'=>$request->designation_id,
            'status_id'=>$request->status_id,
        ]);
        
        return redirect()->route('officersGrid')->with('status', 'Officer Updated Successfully Added');

    }

}
