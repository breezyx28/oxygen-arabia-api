<?php

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangeUserInfoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\FooterController;
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
        // Route::apiResource('mains', MainController::class);
        Route::apiResource('footer', FooterController::class);
        Route::apiResource('missions', MissionController::class)->except(['index']);
        Route::apiResource('projects', ProjectController::class)->except(['index']);
        Route::apiResource('services', ServiceController::class)->except(['index']);
        Route::apiResource('subservices', SubserviceController::class);
        Route::apiResource('contacts', ContactController::class);

        Route::get('statistics', [StatisticsController::class, 'getStatistics']);
        Route::get('/user', [ProfileController::class, 'current_user']);

        // Partnes
        Route::get('mains/{main}', [MainController::class, 'show']);
        Route::post('mains', [MainController::class, 'store']);
        Route::post('mains/{main}', [MainController::class, 'update']);
        Route::delete('mains/{main}', [MainController::class, 'destroy']);

        Route::get('partners/{partner}', [PartnerController::class, 'show']);
        Route::post('partners/{partner}', [PartnerController::class, 'store']);
        Route::post('partners/{partner}', [PartnerController::class, 'update']);
        Route::delete('partners/{partner}', [PartnerController::class, 'destroy']);

        // About page
        Route::get('about-page', [AboutPageController::class, 'index']);
        Route::get('about-page/{aboutPageDetail}', [AboutPageController::class, 'show']);
        Route::post('about-page/{aboutPageDetail}', [AboutPageController::class, 'store']);
        Route::post('about-page/{aboutPageDetail}', [AboutPageController::class, 'update']);
        Route::delete('about-page/{aboutPageDetail}', [AboutPageController::class, 'destroy']);

        // Heroes
        Route::get('heroes', [HeroController::class, 'index']);
        Route::get('heroes/{hero}', [HeroController::class, 'show']);
        Route::post('heroes/{hero}', [HeroController::class, 'store']);
        Route::post('heroes/{hero}', [HeroController::class, 'update']);
        Route::delete('heroes/{hero}', [HeroController::class, 'destroy']);

        // Subservice
        Route::get('subservices/{subservice}', [SubserviceController::class, 'show']);
        Route::post('subservices/{subservice}', [SubserviceController::class, 'store']);
        Route::post('subservices/{subservice}', [SubserviceController::class, 'update']);
        Route::delete('subservices/{subservice}', [SubserviceController::class, 'destroy']);

        Route::apiResource('contact-page', ContactPageController::class);
        Route::apiResource('project-page', ProjectPageDetailsController::class);
    });

    // users messages
    Route::apiResource('users-messages', UsersMessagesController::class);

    // ------------------- All queries -------------------------------
    Route::get('missions', [MissionController::class, 'index']);
    Route::get('partners', [PartnerController::class, 'index']);
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('services', [ServiceController::class, 'index']);
    Route::get('subservices', [SubserviceController::class, 'index']);

    // ------------------- Last records -------------------------------
    Route::get('last-main', [MainController::class, "last"]);
    Route::get('last-footer', [FooterController::class, "last"]);
    Route::get('last-partner', [PartnerController::class, "last"]);
    Route::get('last-mission', [MissionController::class, "last"]);
    Route::get('last-project', [ProjectController::class, "last"]);
    Route::get('last-service', [ServiceController::class, "last"]);
    Route::get('last-subservice', [SubserviceController::class, "last"]);
    Route::get('last-contact', [ContactController::class, "last"]);
    Route::get('last-about-page', [AboutPageController::class, "last"]);
    Route::get('last-contact-page', [ContactPageController::class, "last"]);
    Route::get('last-project-page', [ProjectPageDetailsController::class, "last"]);
    Route::get('last-users-message', [UsersMessagesController::class, "last"]);
});
