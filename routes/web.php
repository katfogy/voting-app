<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\accreditationController;

// Route::get('/', function () {
//     return view('search-user-practiceID');
// })->name('index.home');

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('index.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/process-add-user',[accreditationController::class,'index'])->name('upload.form');
    Route::post('/upload-members', [accreditationController::class, 'upload'])->name('members.upload');
    Route::get('/view-register', [accreditationController::class, 'allMembers'])->name('all.members');
    Route::get('/members/search', [accreditationController::class, 'search']);
    Route::get('/members/searchunaccreditted', [accreditationController::class, 'searchnotcredited']);
    Route::get('/users/{user}/accredit', [accreditationController::class, 'showAccreditForm'])->name('users.accredit');
Route::post('/users/{user}/accredit', [accreditationController::class, 'savePhoto'])->name('users.accredit.save');
Route::get('/view-accredited-members', [accreditationController::class, 'accreditedMembers'])->name('all.accredited.members');
Route::get('/export-accredited', [accreditationController::class, 'exportAccredited'])->name('export.accredited');
});




// Route::post('/upload-acknowledgement', [NominationController::class, 'uploadAcknowledgement'])->name('upload.acknowledgement');

// Route::get('/upload-success', function () {
//     return view('uploadform.upload_success');
// })->name('upload.success');

require __DIR__.'/auth.php';
