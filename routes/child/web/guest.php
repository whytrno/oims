<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AuthenticationController;

Route::get('login', AuthenticationController::class)->name('login');
