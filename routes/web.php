<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskController;

//test 
Route::get('/test', function () {
    return view('test');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::resource('subject', SubjectController::class);

Route::resource('activity', ActivityController::class);

Route::resource('task', TaskController::class);

Route::resource('member', MemberController::class);

Route::get('subjectdashboard/{id}', [SubjectController::class, 'general']);

Route::get('addstudent/{id}', [SubjectController::class, 'addstudent']);

Route::get('addactivity/{id}', [ActivityController::class, 'addactivity']);

Route::get('activitydetail/{id}', [ActivityController::class, 'detail']);

Route::get('studentactivity/{id}', [ActivityController::class, 'task']);

Route::get('getpoint/{id}', [TaskController::class, 'getpoint']);
