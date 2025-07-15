<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TelegramController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/home');
Route::get("home", [TeacherController::class, 'home'])->name('teachers.home');

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get("groups", [GroupController::class, 'index'])->name('groups.index');
    Route::get("groups/{group}", [GroupController::class, 'show'])->name('groups.show');

    Route::get('/sessions/{session}/attendance', [SessionController::class, 'show'])->name('sessions.attendance');
    Route::post('sessions/attendance', [SessionController::class, 'setStatus'])->name('sessions.attendance.store');

    Route::get("students", [StudentController::class, 'index'])->name('students.index');

});

Route::post('telegram/webhook', [TelegramController::class, "handle"]);
