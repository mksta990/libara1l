<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LangController;
use App\Mail\loginlaravel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/////////
Route::get('languageConverter/{locale}', function ($locale) {
    // تحقق إذا كانت اللغة المحددة ضمن القائمة المسموح بها
    if (in_array($locale, ['ar', 'en'])) {
        // تخزين اللغة في الجلسة
        session()->put('locale', $locale);
    }

    return redirect()->back();
})->name('languageConverter');


// route to verifi
Route::get('/send',function(){
    Mail::to('abukhlad990@gmail.com')->send(new loginlaravel());
    return response('sending');
});