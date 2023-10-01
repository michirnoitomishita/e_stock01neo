<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;  // 追加
// use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;

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
Route::resource('message', MessageController::class);
// messageController→MessageControllerに変更

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// LINEのWebhookエンドポイントは公開エンドポイントとして設定
Route::post('/line/webhook/message', 'App\Http\Controllers\LineWebhookController@message')->name('line.webhook.message');


// MessageController の index アクションへのルートを追加
Route::get('/messages', [MessageController::class, 'index'])->name('message.index');

Route::get('/messages/show/{request}', [MessageController::class, 'show'])->name('message.show');

// 以下の行を追加トレーナーからの返信のルーティング
Route::post('/message/{lineUserId}', [MessageController::class, 'create'])->name('message.create');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/linelogin', 'LoginController@login')->name('linelogin');
    // 追加部分ログイン画面
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // 新しいRecordControllerのstoreメソッドへのルートを追加
    Route::post('/record/store', [RecordController::class, 'store'])->name('record.store');// ここに追加
    
    
   Route::get('/recordshow/{id}', [RecordController::class, 'show'])->name('record.show');


});

require __DIR__.'/auth.php';
