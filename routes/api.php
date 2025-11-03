<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\ProjectController; 
use App\Http\Controllers\WalletController;   


Route::prefix("v0.1")->group(function(){
    // Route for users
    // Route::get("/users",[UserController::class, "index"]);
    // Route for savings
    Route::resource("/savings", SavingController::class);
    // Route for projects
    Route::resource("/projects",ProjectController::class);
    // Route for wallets
    Route::resource("/wallets",WalletController::class);
});