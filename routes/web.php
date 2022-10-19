<?php
use Illuminate\Support\Facades\Route;


Route::any('/{all}', function () {
    return redirect()->to(env('URL_FRONTEND'));
})->where('all', '^(?!api).*$');
