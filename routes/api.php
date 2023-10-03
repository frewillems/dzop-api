<?php

use Api\Auth\AuthController;
use Api\CareGoal\CareGoalController;
use Api\CareGoal\NestedCareGoalController;
use Api\CarePlan\CarePlanController;
use Api\CareTask\CareTaskController;
use Api\CareTask\NestedCareTaskController;
use Api\Profile\ProfileController;
use Api\Team\TeamController;
use Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('auth', AuthController::class)->only('store', 'destroy');
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('auth', AuthController::class)->only('index');
        Route::apiResource('users', UserController::class)->only('show');
        Route::apiSingleton('profile', ProfileController::class);
        Route::apiResource('users.care-plans', CarePlanController::class)->only('store');
        Route::apiResource('care-plans', CarePlanController::class)->only('index', 'show');
        Route::apiResource('care-plans.team', TeamController::class)->parameters(['team' => 'user'])->only('index', 'store', 'destroy');
        Route::apiResource('care-plans.care-goals', NestedCareGoalController::class)->shallow();
        Route::apiResource('care-goals', CareGoalController::class)->only('index');
        Route::apiResource('care-goals.care-tasks', NestedCareTaskController::class)->shallow();
        Route::apiResource('care-tasks', CareTaskController::class)->only('index');
    });
});
