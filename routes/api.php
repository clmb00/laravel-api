<?php

use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/search', [ProjectController::class, 'search']);
Route::get('projects/filter-type/{id}', [ProjectController::class, 'filter_type']);
Route::get('projects/filter-tech/{id}', [ProjectController::class, 'filter_tech']);
Route::get('projects/{slug}', [ProjectController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('contacts', [LeadController::class, 'store']);
