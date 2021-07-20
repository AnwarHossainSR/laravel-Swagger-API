<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

Route::post('auth/login', [AuthController::class,'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('users', UserController::class);
});

