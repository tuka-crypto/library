<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::get('/user', function (Request $request) {
    return $request->user();
    })->middleware('auth:sanctum');
    Route::get('test', function () {
    return "this test action";
    });
    Route::middleware('auth:sanctum')->group(function () {
    Route::controller(CategoryController::class)->group(
        function () {
            Route::get('categories', 'index');
            Route::post('categories',  'store');
            Route::put('categories/{id1}',  'update');
            Route::delete('categories/{id}',  'destroy');
            Route::get('categories/{id}',  'show');
        }
    );
    Route::apiResource('books', BookController::class);
    Route::get('books-by-title', [BookController::class, 'getByTitle']);
    Route::get('books-by-category', [BookController::class, 'getByCategory']);

    Route::apiResource('authors', AuthorController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
