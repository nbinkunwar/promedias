<?php
Route::group(['namespace'=>'\\ProfessorOops\Promedias\Http\Controllers'],function(){
    Route::get('ruploads/{path}',['as'=>'image.get','uses'=>'MediaController@view'])->where('path','.*');

});
