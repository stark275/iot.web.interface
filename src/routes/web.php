<?php

use App\Http\Controllers\IotController;
use Illuminate\Support\Facades\Route;

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

Route::get('/monitor', [IotController::class,'monitor'])->name('iot.monitor');

Route::get('/save/{value}', [IotController::class,'create'])->name('iot.save');


Route::get('/', function () {
    return view('welcome');
});
