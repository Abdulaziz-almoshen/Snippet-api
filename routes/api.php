<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
   Route::post('login','SigninController');
   Route::post('logout','SignoutController');
   Route::get('me','MeController');
});
Route::group(['prefix' => 'snippets', 'namespace' => 'Snippet'], function() {
    Route::post('','SnippetController@store');
    Route::get('{snippet}','SnippetController@show');
    Route::patch('{snippet}','SnippetController@update');
    Route::patch('step/{step}','StepController@update');
    Route::post('step/{snippet}','StepController@store');
    Route::delete('step/{step}','StepController@destroy');
});

