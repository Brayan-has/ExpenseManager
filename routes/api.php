<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\ProjectController; 
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ExpenseController;   


Route::prefix("v0.1")->group(function(){
    // Route for users
    Route::resource("/users",UserController::class);
    // Route for restore deleted users
    Route::post("/users/restore/{id}", [UserController::class,"restore"]);
    // Route for savings
    Route::resource("/savings", SavingController::class);
    // Route for projects
    Route::resource("/projects",ProjectController::class);
    // Route for wallets
    Route::resource("/wallets",WalletController::class);
    // Route for expenses
    Route::resource("/expenses",ExpenseController::class);
});