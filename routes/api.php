<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\GroupMemberController;
use App\Http\Controllers\API\GroupSubjectController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RoleUserController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\ScheduleController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\SubjectTeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth/')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('logout', [AuthController::class, 'logout']);

    Route::resource('subjects', SubjectController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('rooms', RoomController::class);

    Route::resource('group-members', GroupMemberController::class);
    Route::resource('group-subjects', GroupSubjectController::class);
    Route::resource('subject-teachers', SubjectTeacherController::class);
    Route::resource('role-users', RoleUserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('schedules', ScheduleController::class);

});
