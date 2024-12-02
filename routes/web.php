<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');
Route::post('/properties/{property}/inquiry', [PropertyController::class, 'inquiry'])->name('property.inquiry');
