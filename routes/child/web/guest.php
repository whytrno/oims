<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\AuthenticationPage;

Route::get('login', AuthenticationPage::class)->name('login');
