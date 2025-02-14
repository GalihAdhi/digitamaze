<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Billing;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\GuruList;
use App\Http\Livewire\MuridList;
use App\Http\Livewire\KelasList;
use App\Http\Livewire\KelasInfo;
use App\Http\Livewire\WaliMuridList;
use GuzzleHttp\Middleware;

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

Route::get('/', function(){
    return redirect('sign-in');
});

Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');



Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');


Route::group(['middleware' => 'auth'], function () {
Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('muridlist', muridlist::class)->name('manage-siswa');
Route::get('gurulist', gurulist::class)->name('manage-guru');
Route::get('kelaslist', kelaslist::class)->name('manage-kelas');
Route::get('kelasinfo/{kelasid}', kelasinfo::class)->name('kelas-info');
Route::get('wali-murid', WaliMuridList::class)->name('wali-murid');
});