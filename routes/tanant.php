<?php
use App\Tanant\Manager;

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/projects', 'ProjectsController');
