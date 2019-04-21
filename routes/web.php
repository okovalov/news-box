<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('news', 'NewsTopicController@index')->name('newsTopic.index');
Route::get('weather', 'WeatherController@index')->name('weather.index');