<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\BorrowingController;
use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(["middleware" => "auth:sanctum"],function(){
    Route::apiResource("books",BookController::class);
    Route::apiResource("borrowings",BorrowingController::class);
    Route::apiResource("borrowers",BorrowerController::class);
    Route::post('/books/bulk', [BookController::class, 'bulkstore']);
    Route::post('/borrowers/bulk', [BorrowerController::class, 'bulkstore']);
    Route::post('/borrowings/bulk', [BorrowingController::class, 'bulkstore']);
});
