<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){

    Route::get('/video-chat', function () {
        // fetch all users apart from the authenticated user
        $users = \App\Models\User::where('id', '<>', \Illuminate\Support\Facades\Auth::id())->get();
        return view('video-chat', ['users' => $users]);
    })->name('view-chat');

// Endpoints to call or receive calls.
    Route::post('/video/call-user', [\App\Http\Controllers\VideoChatController::class,'callUser']);
    Route::post('/video/accept-call', [\App\Http\Controllers\VideoChatController::class,'acceptCall']);
    Route::post('/video/end-call', [\App\Http\Controllers\VideoChatController::class,'endCall']);
});
