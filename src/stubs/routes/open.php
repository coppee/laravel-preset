<?php

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
    Route::get('/', 'HomepageController@index')->name('home');
    Route::get('/{slug}', 'PagesController@show')->name('pages.show');
});