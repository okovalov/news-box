<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('news', 'NewsTopicsController@index')->name('newsTopics.index');