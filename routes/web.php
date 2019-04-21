<?php

Route::get('/', 'WeatherController@index')->name('weather.index');

Route::get('news', 'NewsTopicController@index')->name('newsTopic.index');
Route::get('weather', 'WeatherController@index')->name('weather.index');
Route::get('exchange', 'ExchangeController@index')->name('exchange.index');