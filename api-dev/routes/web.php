<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebController;

Route::get('/', [WebController::class, 'welcome']);
