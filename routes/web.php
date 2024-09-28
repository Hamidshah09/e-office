<?php

use App\Http\Controllers\letterController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\sectionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function(){
    return view('login.login');
});
Route::get('/letters', [letterController::class, 'index'])->name('lettersgrid');
Route::get('/letters/create', [letterController::class, 'create'])->name('lettercreate');

Route::get('/officers', [OfficerController::class, 'index'])->name('officersGrid');
Route::get('/officers/newofficer', [OfficerController::class, 'newofficer'])->name('newofficer');
Route::post('/officers/savenewofficer', [OfficerController::class, 'savenewofficer'])->name('savenewofficer');
Route::get('/officers/{id}/edit', [OfficerController::class, 'edit'])->name('editofficer');
Route::put('/officers/{id}', [OfficerController::class, 'updateofficer'])->name('updateofficer');
Route::get('/officers/search', [OfficerController::class, 'search'])->name('officerssearch');

Route::resource('/section', sectionsController::class)->only(['index', 'show','create' ,'store','edit', 'update']);;
