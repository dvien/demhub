<?php

/**
 * Frontend Controllers
 */
get('/', 'FrontendController@index')->name('home');
get('macros', 'FrontendController@macros');
get('about', 'FrontendController@about');
get('policy', 'FrontendController@policy');
get('terms', 'FrontendController@terms');

/**
 * Division Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
 */
get('divisions', 'DivisionController@index');
get('division/{slug}', 'DivisionController@show')->where('slug', '[A-Za-z_\-]+');

/**
 * Info Resources Routes
 * Namespaces indicate folder structure
 * TODO - Implement folder structure
*/
get('resources', 'InfoResourceController@index');

/**
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function ()
{
	get('dashboard', 'DashboardController@index')->name('frontend.dashboard');
	get('profile/edit', 'ProfileController@edit')->name('frontend.profile.edit');
	patch('profile/update', 'ProfileController@update')->name('frontend.profile.update');
	get('userhome', 'UserController@showUserHome')->name('frontend.user.userhome');
});
