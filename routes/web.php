<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\MailController;

use App\Http\Controllers\TicketController;

use App\Http\Controllers\ArticleController;

use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');

Route::get('/contact-us', [MailController::class, 'showForm'])->name("contact-us");

Route::post('/send-mail', [MailController::class, 'sendMail'])->name("send-mail");

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Quando creiamo un controller che rispetta il CRUD, abbiamo accesso a "Route::resource() che riceve tre parametri. 
// Il primo è il nome al plurale dell'entità che stiamo trattando, es: Categories"
// Il secondo è il nome del controller che rispetta la metodologia CRUD

Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);

Route::resource('articles', ArticleController::class)->middleware(['auth', 'verified']);

Route::resource('tickets', TicketController::class)->middleware(['auth', 'verified']);

Route::get('tickets/closed/{ticket}', [TicketController::class, 'closeTicket'])->name('tickets.closed');

Route::get('/articles-by-author/{author}', [ArticleController::class, 'articlesByAuthor'])->name('articles.byAuthor');