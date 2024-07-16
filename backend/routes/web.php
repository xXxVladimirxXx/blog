<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return app()->version();
})->where('any', '.*')->name('general');