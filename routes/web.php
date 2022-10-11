<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => false
    ]);
});

Route::get('/login', function (){
    return response()->json([
        'message' => 'Unauthenticated'
    ]);
})->name('login');
