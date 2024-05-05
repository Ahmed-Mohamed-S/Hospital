<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Models\Doctor;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[HomeController::class,'index']);


Route::get('/home',[HomeController::class,'redirect']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view',[AdminController::class,'AddView']);
Route::post('/upload_doctor',[AdminController::class,'AddDoctor']);
Route::post('/appointment',[HomeController::class,'Appointment'])->middleware('auth');
Route::get('/my_appoint',[HomeController::class,'my_Appoint']);
Route::get('/cancel_appoint/{id}',[HomeController::class,'Cancel']);
Route::get('/showappointment',[AdminController::class,'ShowAppointment']);
Route::get('/approved/{id}',[AdminController::class,'approvedAppointment']);
Route::get('/cancelled/{id}',[AdminController::class,'cancelledAppointment']);
Route::get('/showdoctors',[AdminController::class,'ShowDoctors']);
Route::get('/delete_doc/{id}',[AdminController::class,'DeleteDoctor']);
Route::get('/update_doc/{id}',[AdminController::class,'UpdateDoctor']);
Route::post('/edit_doc/{id}',[AdminController::class,'EditDoctor']);
Route::get('/view_mail/{id}',[AdminController::class,'ViewMail']);
Route::post('/sendemail/{id}',[AdminController::class,'SendEmail']);


Route::post('search', function(Request $request){
    $searchkey = $request->input('searchkey');
    $doctors = Doctor::where('name', 'like', '%'.$searchkey.'%')->get();
    return view('user.doctors', compact('doctors'));
});

Route::post('/lang',function(Request $request){
    Session::put('locale',$request->locale);
    return redirect()->back();

})->name('ChangeLanguage');











