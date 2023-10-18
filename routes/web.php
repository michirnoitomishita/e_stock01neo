<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\LineWebhookController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// LINEのWebhookエンドポイント
Route::post('/line/webhook/message', 'App\Http\Controllers\LineWebhookController@message')->name('line.webhook.message');

// Message Routes

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/show/{id}', [MessageController::class, 'show'])->name('message.show');
Route::post('/messages/{id}', [MessageController::class, 'create'])->name('message.create');
Route::post('/send-line-message', [MessageController::class, 'sendMessage'])->name('send-line-message.store');

// 'create'を除外してリソースルートを定義
Route::resource('message', MessageController::class)->except(['create']);

// Middleware applied routes
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Record Routes
    Route::post('/record/store', [RecordController::class, 'store'])->name('record.store');
    Route::get('/record/show/{id}', [RecordController::class, 'show'])->name('record.show');

Route::post('/messages/create/{id}', [MessageController::class, 'create'])->name('message.create');



    // Line User Routes
    Route::get('/lineusers/{id}', [LineWebhookController::class, 'show'])->name('lineusers.show');
});

Route::get('/message-sent', function () {
    return view('message-sent');
})->name('message-sent');


require __DIR__.'/auth.php';
