<?php
use App\checkstd;
use App\Checkhistory;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use Rundiz\Thaidate\Thaidate;
use Illuminate\Support\Facades\Input;
Date::setLocale('th');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServi ceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Controller@index')->name('index');
//Route::get('/', function () {
  //  return view('homecheck');
//});
Route::get('/test', function () {
    return view('login');
});

Route::get('/admin', 'adminController@index')->name('admin');
Route::get('/admin/adduser','adminController@adduser')->name('adduser');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::patch('result/{std_id}','Controller@resultData');
Route::post('search/','HomeController@search')->name('result');

Route::get('/data',function (){
    return view::make('index');
});

Route::post('/result/{std_id}',function (){
    $std_id = Input::get('std_id');
});


Route::get('admin/form', function () {
    return view('admin/form');
});

Route::any('search' , 'HomeController@search');

Route::get('/ac', function () {
  echo thaidate('วันl ที่ j F พ.ศ. Y เวลา H:i:s');
});

Route::get('search','searchController@index')->name('search');
Route::get('autocomplete','searchController@autocomplete')->name('autocomplete');
Route::post('result','Controller@resultNewData')->name('result');
route::get('/nindex',function (){
   return view('nindex');
});


route::get('/result', function(){
    $ss =  app('Illuminate\Http\Response')->status();
   if ($ss == 200) {
       return ("API Error : Your Session Has been Expired");

   }
   elseif ($ss == 403){
       return response()->json(['error_code' => 'SESSION403-1', 'message' => 'Forbidden Access']);
   }
   elseif ($ss = 400){
       return "Bad Request";
   }
})->name("Error!");

route::get('/nresult',function (){
   return view('nresult');

});

Route::get('rehome',function(){
   return redirect('/');
});
