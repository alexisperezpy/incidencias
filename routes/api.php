<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/proyecto/{id}/niveles','Admin\LevelController@byProject')->name('level.project');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
