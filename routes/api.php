<?php

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\ChangeUserInfoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPageDetailsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SubserviceController;
use App\Http\Controllers\UsersMessagesController;
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

Route::group(['prefix' => 'v1'], function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::put('/user/update', [ChangeUserInfoController::class, 'update'])->middleware('auth:sanctum');


    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('banners', BannersController::class);
        // Route::apiResource('footer', FooterController::class);
        // Route::apiResource('services', ServiceController::class)->except(['index']);
        // Route::apiResource('subservices', SubserviceController::class);
        // Route::apiResource('contacts', ContactController::class);

        Route::get('statistics', [StatisticsController::class, 'getStatistics']);
        Route::get('/user', [ProfileController::class, 'current_user']);

        // Main Page (Landing page)
        Route::get('mains/{main}', [MainController::class, 'show']);
        Route::post('mains', [MainController::class, 'store']);
        Route::post('mains/{main}', [MainController::class, 'update']);
        Route::delete('mains/{main}', [MainController::class, 'destroy']);

        // Form
        Route::get('forms/{form}', [FormController::class, 'show']);
        Route::post('forms', [FormController::class, 'store']);
        Route::post('forms/{form}', [FormController::class, 'update']);
        Route::delete('forms/{form}', [FormController::class, 'destroy']);

        // Subservice
        // Route::get('subservices/{subservice}', [SubserviceController::class, 'show']);
        // Route::post('subservices/{subservice}', [SubserviceController::class, 'store']);
        // Route::post('subservices/{subservice}', [SubserviceController::class, 'update']);
        // Route::delete('subservices/{subservice}', [SubserviceController::class, 'destroy']);

        // Route::apiResource('contact-page', ContactPageController::class);
        // Route::apiResource('project-page', ProjectPageDetailsController::class);
    });

    // users messages
    // Route::apiResource('users-messages', UsersMessagesController::class);

    // ------------------- All queries -------------------------------
    // Route::get('missions', [MissionController::class, 'index']);

    // ------------------- Last records -------------------------------
    Route::get('last-main', [MainController::class, "last"]);
    Route::get('last-form', [FormController::class, "last"]);
    Route::get('last-banner', [BannersController::class, "last"]);
});
