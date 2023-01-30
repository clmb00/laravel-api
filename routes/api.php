<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/search', [ProjectController::class, 'search']);
Route::get('projects/{slug}', [ProjectController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
