<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Inistitute;
use App\Models\Subject;
use App\Models\Receiveomr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OmrController extends Controller
{
 public function home(){

    $users = Receiveomr::orderBy('id', 'desc')->paginate(10);
    // dd($users);

        return view('home', compact('users'));     
    }

    public function centerWise($eiin){
// dd($request);
 $data = Receiveomr::where('CENTER_CODE', $eiin )->orderBy('id', 'desc')->paginate(10);

   // $data = json_encode($data);
   // dd($data);
                        $id=1;
                        $absentData='';
        foreach ($data as $key => $absent)
                    {

                    $absentData.='<tr>'.

                    '<td>'.$id++.'</td>'.

                    '<td>'.$absent->CENTER_CODE.'</td>'.

                    '<td>'.$absent->MADRASAH_NAME.'</td>'.

                    '<td>'.$absent->CENTER_EIIN.'</td>'.

                    '<td>'.$absent->ADDRESS.'</td>'.

                    '<td>'.$absent->SUBJECT_CODE.'</td>'.

                    '<td>'.$absent->BIMA_NO.'</td>'.
                    '<td>'.$absent->BIMA_DATE.'</td>'.
                    '<td>'.$absent->ENTRY_DATE.'</td>'.
                    '<td>'.$absent->ENTRY_OMR.'</td>'.
                     '<td>'.$absent->INSERTED_BY.'</td>'.
                    '<td>'.$absent->REST_OMR.'</td>'.
                   
                    '</tr>';

                    }  

// dd($absentData);

        return response()->json([$absentData]);

    }

    public function subjectWise(Request $request){
// dd($request->get('subcode'));
       $subcode = $request->get('subcode');
       $eiin = $request->get('eiin');

       $data = Receiveomr::where('CENTER_CODE', $eiin )->where('SUBJECT_CODE', $subcode )->orderBy('id', 'desc')->paginate(10);

   // $data = json_encode($data);
   // dd($data);
                        $id=1;
                        $absentData='';
        foreach ($data as $key => $absent)
                    {

                    $absentData.='<tr>'.

                    '<td>'.$id++.'</td>'.

                    '<td>'.$absent->CENTER_CODE.'</td>'.

                    '<td>'.$absent->MADRASAH_NAME.'</td>'.

                    '<td>'.$absent->CENTER_EIIN.'</td>'.

                    '<td>'.$absent->ADDRESS.'</td>'.

                    '<td>'.$absent->SUBJECT_CODE.'</td>'.

                    '<td>'.$absent->BIMA_NO.'</td>'.
                    '<td>'.$absent->BIMA_DATE.'</td>'.
                    '<td>'.$absent->ENTRY_DATE.'</td>'.
                    '<td>'.$absent->ENTRY_OMR.'</td>'.
                     '<td>'.$absent->INSERTED_BY.'</td>'.
                    '<td>'.$absent->REST_OMR.'</td>'.
                   
                    '</tr>';

                    }  

                      return response()->json([$absentData]);

}

     public function omrEntryForm(){
             if(Auth::check()){
            return view('omrentryform');
        }     
        
         return redirect("login")->withSuccess('Opps! You do not have access*********************************');      
    }

public function getInstitutes(){

$inistitutes = Inistitute::distinct()->select('CENTER_CODE','MADRASAH_NAME')->orderBy('CENTER_CODE', 'asc')->get();
//dd($inistitutes);
//->distinct()->orderBy('CENTER_CODE', 'asc')  value: item.CENTER_CODE,
 //       text: item.MADRASAH_NAME
    return response()->json($inistitutes);
}

public function getSubject($eiin){
   $group_code = Inistitute::pluck('GROUP_CODE')->toArray();
$group_code = Inistitute::where('CENTER_CODE',$eiin)->pluck('GROUP_CODE')->toArray();
// dd($group_code);
$subject = Subject::whereIn('GROUP_CODE',$group_code)->get();
// dd($subject);

    return response()->json($subject);
}
    //$users = User::whereIn('id', [1,2,3,4])->get();


public function getSubjectUd(){
$subject = Subject::All();
// dd($subject);

    return response()->json($subject);

}
public function getInstitutesInfo(Request $request){
$center_code = $request->get('eiin');
$sub = $request->get('subcode');

// $empData = DB::table('exam_routins')
// ->join('fazil_pass_subjects', 'exam_routins.SUBJECT_CODE', '=', 'fazil_pass_subjects.SUBJECT_CODE')
//                 ->select('exam_routins.EXAM_CODE','exam_routins.SUBJECT_CODE','fazil_pass_subjects.SUBJECT_NAME')
//               ->where('exam_routins.EXAM_DATE', $date)
//               ->get();


$stdInfo = DB::table('subjects')->join('inistitutes','subjects.GROUP_CODE','=','inistitutes.GROUP_CODE')->where('SUBJECT_CODE',$sub)->where('CENTER_CODE',$center_code)->get();


$empData = '';
$empData.='<b>Madrasah Name : </b>'.$stdInfo[0]->MADRASAH_NAME.'<b> CENTER_CODE: </b>'.$stdInfo[0]->CENTER_CODE.'<b> CENTER_EIIN: </b>'.$stdInfo[0]->CENTER_EIIN.'<b> DIVISION: </b>'.$stdInfo[0]->DIVISION.'<b> DISTRICT-THANA-PHONE : </b>'.$stdInfo[0]->DISTRICT.','.$stdInfo[0]->THANA.','.$stdInfo[0]->PHONE.'<b> Total Student: </b><b id="#total_std">'.$stdInfo[0]->TOTAL_STUDENTS.'</b>';
// dd($stdInfo);
    return response()->json($stdInfo);
}

public function getReceiveOmr(Request $request){
$center_code = $request->get('eiin');
$sub = $request->get('subcode');



$total = Receiveomr::where('CENTER_CODE', $center_code)->where('SUBJECT_CODE', $sub)->sum('ENTRY_OMR');
// dd($total);
return response()->json(['success'=> $total]);

}


public function etypeStore(Request $request){
    // dd($request->input('subject_code'));
    if(is_null($request->input('subject_code'))){

         return response()->json(['success'=>' Please Subject  select Properly']);
    }else{

  if (is_numeric($request->input('subject_code'))){

    if(is_null($request->input('CENTER_EIIN'))){

         return response()->json(['success'=>' Please Subject  select Properly']);
    }
        else{

// dd('number is an integer');

        



$processexist = Receiveomr::where('CENTER_CODE', $request->institutes)
        ->where('SUBJECT_CODE', $request->subject_code)
        ->where('BIMA_NO', $request->bima_no)
        ->where('BIMA_DATE', $request->bima_date)
        ->first();
        
        // dd($processexist);
  


 if($processexist == null)//if doesn't exist: create
        {

            $processes = Receiveomr::create([
                'CENTER_CODE' => $request->institutes,
                'CENTER_EIIN' => $request->CENTER_EIIN,
                'DISTRICT' => $request->DISTRICT,
                'THANA' => $request->THANA,
                'PHONE' => $request->PHONE,
                'SUBJECT_CODE' => $request->subject_code,
                'BIMA_NO' => $request->bima_no,
                'ENTRY_DATE' => $request->ENTRY_DATE,
                'BIMA_DATE' => $request->bima_date,
                'ENTRY_OMR' => $request->quantity,
                'REST_OMR' => $request->REST_OMR,
                'INSERTED_BY'=>auth()->user()->email,
                'MADRASAH_NAME' => $request->MADRASAH_NAME
            ]); 
            return response()->json(['success'=>'Data inserted successfully']);
        }
          else //if exist: update
        {
         

$processes = Receiveomr::where('id', $processexist->id)
                ->update([
                    'ENTRY_OMR' => $request->quantity,
                    'REST_OMR' => $request->REST_OMR,
                    'UPDATED_BY'=>auth()->user()->email
                ]);

                return response()->json(['success'=>'Data Update successfully']);

   }

}

   
} else {
    return response()->json(['success'=>'Please select Subject Code And center Code Properly']);

}

        
}

}


public function store(Request $request)
    {  
        request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'mobile_number' => 'required|unique:users'
        ]);
         
        $data = $request->all();
        $check = Contact::insert($data);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if($check){ 
        $arr = array('msg' => 'Successfully submit form using ajax', 'status' => true);
        }
        return Response()->json($arr);
       
    }


}

 


