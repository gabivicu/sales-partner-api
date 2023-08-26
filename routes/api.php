<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::post('/register-lead', [ClientController::class, 'register']);
