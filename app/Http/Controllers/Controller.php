<?php

namespace App\Http\Controllers;

use http\Env\Response;
use http\Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use \MasterRO\LaravelXSSFilter\FilterXSS;
use App\checkstd;
use App\checkhistory;
use App\Http\Controllers\Encoding;
use Carbon\Carbon;
use Rundiz\Thaidate\Thaidate;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);
        $current = Carbon::now();
        $checkstd = checkstd::all();
        foreach ($checkstd as $chkshow)
{
     $chkshow->std_name;
}
return view('nindex',compact('std_id'));
        
    }

    public function resultData($std_id)
    {
       $chklogshow = Checkhistory::where('std_id',$std_id)->get();
       $chkshow = checkstd::findOrFail($std_id);
        return view('/result',compact('chkshow'))->with(array('chklogshow'=>$chklogshow));
        
    }


    public function resultNewData(Request $request){
        $std_search = $request->input('std_id');
        $gretoken = $request->input('g-recaptcha-response');
        $chklogshow = Checkhistory::where('std_id',$std_search)->get();
    
       try { 
           $chkshow = checkstd::findOrFail($std_search);
       } catch (ModelNotFoundException $exception) {
           return response()->json(['error_code' => '0015', 'message' => ' Your Resquest was not found! ']);
       }


       // check reCaptcha Token
        $secretKey = "6LdrAZgUAAAAAD00_okGiasF19t5deuBBDeTdkXl";
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($gretoken);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            return view('result',compact('chkshow','validate'))->with(array('chklogshow'=>$chklogshow));
        } else {
            return redirect('/');

        }

    }
    public function student_history()
    {
        return $this->belongsToMany('App\checkstd');
        return $this->has0ne('App\checkhistory');
      
    }
}
