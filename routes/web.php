<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dataController;
use App\Models\DataSend;
use App\Models\Receiver;
use App\Notifications\telegramNotification;
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

Route::get('/',"App\Http\Controllers\dataController@index")->name("home");

Route::get('/fetchidsajax',"App\Http\Controllers\dataController@fetchIDsAjax")->name("fetchidsAjax");
Route::get('/customeMessage',"App\Http\Controllers\dataController@sendCustomMessage")->name("customMessage");
Route::get('/customePhoto',"App\Http\Controllers\dataController@sendCustomePhoto")->name("customPhoto");
Route::post('/person',"App\Http\Controllers\dataController@store")->name('save');
Route::delete('/deleteperson/{id}',"App\Http\Controllers\dataController@deletePerson")->name('datadelete');
Route::put('/deletereceiver/{id}',"App\Http\Controllers\dataController@deleteReceiver")->name('receiverdelete');
Route::put('/unblockReceiver/{id}',"App\Http\Controllers\dataController@unblockReceiver")->name('unblockReceiver');
Route::view('/example', 'viewName')->name("welcome");
//Route::get('/send',"App\Http\Controllers\dataController@sendMessage")->name('send');
Route::put('/textedit/{id}',"App\Http\Controllers\dataController@editMessage")->name('textedit');
Route::post('/users',"App\Http\Controllers\dataController@addReceiver")->name('saveuser');
Route::put('/selectreceiver/{id}', [dataController::class, 'selectReceiver'])->name('receiverSelect');
Route::put('/modifyImage/{id}', [dataController::class, 'modifyImage'])->name('modifyImage');
Route::put('/modifyBirthParams', [dataController::class, 'modifyBirthParams'])->name('modifyBirthParams');
Route::put('/sendtype/{id}', [dataController::class, 'modifyType'])->name('modifyType');

Route::get('/greetingCHeck',"App\Http\Controllers\dataController@birthdayGreetings");
Route::get('/getTags',"App\Http\Controllers\dataController@getTags");
Route::post('/insertTag',"App\Http\Controllers\dataController@insertTag")->name('insertTag');
Route::put('/updateTagVal/{tag}', [dataController::class, 'updateTagVal'])->name('updateTagVal');
Route::delete('/deleteTag/{tag}',"App\Http\Controllers\dataController@deleteTag")->name('deleteTag');




//---------------------------- testing routes
Route::get('/toTestGet',"App\Http\Controllers\dataController@toTest");
Route::post('/toTestPost',"App\Http\Controllers\dataController@toTest");