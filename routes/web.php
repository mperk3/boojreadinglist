<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReadingListController;

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

Route::get('/', function () {
    return redirect('/readinglist');
});

Route::post('readinglist/create',[App\Http\Controllers\ReadingListController::class,'create']);
Route::get('readinglist/sort/{sortby?}/{sortorder?}',[App\Http\Controllers\ReadingListController::class,'index']);
Route::resource('readinglist', ReadingListController::class)->except('edit');
