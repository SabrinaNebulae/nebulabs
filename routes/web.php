<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TasksController;

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
Route::post('livewire/message/{name}', '\Livewire\Controllers\HttpConnectionHandler');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function()
    {   
        Route::get('/', function () { return view('welcome'); })->name('global-index');
        Route::get('/idea', [IdeaController::class, 'index'])->name('idea.index');
        Route::get('/ideas/{idea:slug}', [IdeaController::class, 'show'])->name('idea.show');
        Route::post('livewire/message/{name}', '\Livewire\Controllers\HttpConnectionHandler');

        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {    
            Route::get('/task/dashboard', function () {
                return view('tasklist/dashboard');
            })->name('dashboard');

            Route::get('/task',[TasksController::class, 'add']);
            Route::post('/task',[TasksController::class, 'create']);
            
            Route::get('/task/{task}', [TasksController::class, 'edit']);
            Route::post('/task/{task}', [TasksController::class, 'update']);
        });
    }
);
