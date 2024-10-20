<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\letterController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\sectionsController;
use App\Http\Controllers\testController;
use App\Http\Controllers\trackingController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth'])->group(function () {
    
    Route::controller(loginController::class)->group(function(){
        Route::get('login', 'login')->name('login')->withoutMiddleware(['auth']);
        Route::post('login', 'loginmatch')->name('loginmatch')->withoutMiddleware(['auth']);
        Route::get('logout', 'logout')->name('logout');
        Route::get('/', 'dashboard')->name('dashboard');
    });
    Route::resource('/roles', RolesController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::controller(usersController::class)->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::post('users', 'store')->name('users.store');
        Route::get('users/create', 'create')->name('users.create');
        Route::get('users/{user}/edit', 'edit')->name('users.edit');
        Route::put('users/{user}', 'update')->name('users.update');
    });
    Route::controller(letterController::class)->group(function(){
        Route::get('/letters',  'index')->name('lettersgrid');
        Route::get('/letters/create',  'create')->name('lettercreate');
        Route::post('/letters/store',  'store')->name('letterstore');
        Route::get('/letters/{id}/edit',  'edit')->name('letteredit');
        Route::post('/letters/{id}',  'update')->name('letterupdate');
        
    });
    Route::controller(trackingController::class)->group(function(){
        Route::get('/inbox',  'inbox')->name('inbox');
        Route::get('/outbox',  'outbox')->name('outbox');
        Route::post('/outbox/update',  'receive')->name('receive');
        Route::get('/sending',  'sending')->name('sending');
        Route::get('/sentitems',  'sentitems')->name('sentitems');
        Route::post('/sentitems/update',  'recall')->name('recall');
        Route::post('/inbox/update',  'inboxupdate')->name('inboxupdate');
        Route::post('/sending/update',  'send_concerned')->name('send_concerned');
    });

    Route::get('/officers', [OfficerController::class, 'index'])->name('officersGrid')->middleware(['auth']);
    Route::get('/officers/newofficer', [OfficerController::class, 'newofficer'])->name('newofficer');
    Route::post('/officers/savenewofficer', [OfficerController::class, 'savenewofficer'])->name('savenewofficer');
    Route::get('/officers/{id}/edit', [OfficerController::class, 'edit'])->name('editofficer');
    Route::put('/officers/{id}', [OfficerController::class, 'updateofficer'])->name('updateofficer');
    Route::get('/officers/search', [OfficerController::class, 'search'])->name('officerssearch');

    Route::resource('/section', sectionsController::class)->only(['index', 'show','create' ,'store','edit', 'update']);;
    Route::resource('/files', FilesController::class)->only(['index', 'show','create' ,'store','edit', 'update']);;
});
Route::get('/test', [testController::class, 'index']);
Route::post('/test/update', [testController::class, 'update'])->name('save');