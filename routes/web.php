<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\AdminContributorController;
use App\Http\Middleware\AdminMiddleware;

// Public Routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/book/{id}', [BookController::class, 'show']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/author/{id}', [AuthorController::class, 'show']);

Route::get('/essays', [EssayController::class, 'index']);
Route::get('/essays/{essay}', [EssayController::class, 'show'])->name('essays.show');

Route::get('/about', function () {
    return view('pages.about');
});

// Contributor System
Route::get('/write-for-us', [SubmissionController::class, 'create']);
Route::post('/write-for-us', [SubmissionController::class, 'store']);

// Admin Routes (protected)
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);

    // Books
    Route::get('/admin/books/create', [AdminController::class, 'createBook']);
    Route::post('/admin/books/store', [AdminController::class, 'storeBook']);
    Route::get('/admin/books/edit/{id}', [AdminController::class, 'editBook']);
    Route::post('/admin/books/update/{id}', [AdminController::class, 'updateBook']);
    Route::get('/admin/books/delete/{id}', [AdminController::class, 'deleteBook']);

    // Authors
    Route::get('/admin/authors/create', [AdminController::class, 'createAuthor']);
    Route::post('/admin/authors/store', [AdminController::class, 'storeAuthor']);
    Route::get('/admin/authors/edit/{id}', [AdminController::class, 'editAuthor']);
    Route::post('/admin/authors/update/{id}', [AdminController::class, 'updateAuthor']);

    // Essays
    Route::get('/admin/essays/create', [AdminController::class, 'createEssay']);
    Route::post('/admin/essays/store', [AdminController::class, 'storeEssay']);
    Route::get('/admin/essays/edit/{id}', [AdminController::class, 'editEssay']);
    Route::post('/admin/essays/update/{id}', [AdminController::class, 'updateEssay']);

    // Submissions
    Route::get('/admin/submissions', [AdminController::class, 'listSubmissions']);
    Route::get('/admin/submissions/{id}', [AdminController::class, 'viewSubmission']);
    Route::patch('/admin/submissions/{id}', [AdminController::class, 'updateSubmission']);
    Route::post('/admin/submissions/{id}/accept', [AdminController::class, 'acceptSubmission']);
    Route::post('/admin/submissions/{id}/reject', [AdminController::class, 'rejectSubmission']);

    // Contributors
    Route::get('/admin/contributors', [AdminContributorController::class, 'index']);
    Route::get('/admin/contributors/{contributor}', [AdminContributorController::class, 'show']);
});
