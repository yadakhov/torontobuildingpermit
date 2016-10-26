<?php

use App\Http\Controllers\PageController;

Route::get('/', ['uses' => PageController::class . '@front', 'as' => 'front']);
