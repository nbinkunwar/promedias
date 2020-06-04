<?php
Route::group(['namespace'=>'\\ProfessorOops\Promedias\Http\Controllers'],function(){
    Route::post('image','MediaController@store');

});
