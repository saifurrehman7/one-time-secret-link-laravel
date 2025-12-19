<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecretLinks;
 
Route::get('/', [SecretLinks::class, 'viewHomepage'])->name('home');
Route::any('/create-link', [SecretLinks::class, 'createSecretLink'])->name('create-link');

Route::get('/private/{slug}', [SecretLinks::class, 'show'])->name('show-password');
// Route::post('/send-password', [SecretLinks::class, 'show'])->name('show-password');
Route::get('/secret/{slug}/view', [SecretLinks::class, 'view'])->name('view-password');
Route::post('/send-secret/{slug}', [SecretLinks::class, 'sendSecret'])->name('send-secret');
Route::get('/show-secret-code/{encodedId}', [SecretLinks::class, 'showSecretCode']);
Route::get('/burn-link/{encodedId}', [SecretLinks::class, 'burnLink'])->name('burn-link');
