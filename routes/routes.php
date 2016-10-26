<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PermitController;

Route::get('/', ['uses' => PageController::class . '@front', 'as' => 'front']);
Route::get('/about', ['uses' => PageController::class . '@about', 'as' => 'about']);

Route::get('/search', ['uses' => PermitController::class . '@search', 'as' => 'search']);
Route::get('/permit/{permitId}/{slug?}', ['uses' => PermitController::class . '@permit', 'as' => 'permit']);
