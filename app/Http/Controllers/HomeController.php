<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


use App\checkstd;
use App\checkhistory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        $stuid = $request->stu_id;
    //    $chklogshow = Checkhistory::search('std_id',$stuid)->get();
        $chkshow = checkstd::findOrFail($stuid);

        return view('result')->with(array('chklogshow'=>$chklogshow,'chkshow '=>$chkshow ));
        //$std_id = Input::get ( 'std_id' );
        //$stu = DB::table('student')->where('std_id', 'LIKE','%'.$std_id.'%')->first();
        //if(count($stu) > 0)
          //  return view('result')->withDetails($stu)->withQuery ( $std_id );
       // else return view ('result')->withMessage('No Details found. Try to search again !');
    }


}
