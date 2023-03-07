<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OmrController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return redirect('home');
});
 

Route::get('/home', [OmrController::class, 'home']);

Route::get('/center-wise-omr/{eiin}', [OmrController::class, 'centerWise']);
Route::get('/subject-wise-omr', [OmrController::class, 'subjectWise']);


Route::get('/omr', [OmrController::class, 'omrEntryForm']);
Route::get('/dashboard', [OmrController::class, 'omrEntryForm']);
Route::get('/institutes', [OmrController::class, 'getInstitutes']);
Route::get('/subject/undefined', [OmrController::class, 'getSubjectUd']);
Route::get('/subject/{eiin}', [OmrController::class, 'getSubject']);
Route::get('/institutesinfo', [OmrController::class, 'getInstitutesInfo']);
Route::get('/receivedomr', [OmrController::class, 'getReceiveOmr']);
Route::get('/save-form', [OmrController::class, 'etypeStore']);



Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('getuser', [AuthController::class, 'getUser']);
Route::get('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::get('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboardd', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');