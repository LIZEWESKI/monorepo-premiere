<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("books",BookController::class);
Route::apiResource("borrowings",BorrowingController::class);
Route::apiResource("borrowers",BorrowerController::class);
Route::post('/books/bulk', [BookController::class, 'bulkstore']);
