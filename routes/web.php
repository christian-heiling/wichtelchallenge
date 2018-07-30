<?php

/* App */

Route::group(['prefix' => 'app'], function () {
    Voyager::routes();
});

Route::get('/app/wishes/{wish}/publish', 'WishController@publish')->name('voyager.wishes.publish');
Route::get('/app/wishes/{wish}/unpublish', 'WishController@unpublish')->name('voyager.wishes.unpublish');

