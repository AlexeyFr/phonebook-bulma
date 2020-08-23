<?php

Route::get('/','PhonebookController@index');

Route::resource('phonebook','PhonebookController');

Route::post('getData','PhonebookController@getData');