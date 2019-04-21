<?php
Route::post('weather', 'WeatherController@show')->name('weather.show');
Route::post('exchange', 'ExchangeController@show')->name('exchange.show');

