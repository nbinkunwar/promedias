<?php
Route::group(['namespace'=>'\\ProfessorOops\Promedias\Http\Controllers'],function(){
    Route::get('img/{path:.*}',['as'=>'image.get','uses'=>'MediaController@view']);

});
