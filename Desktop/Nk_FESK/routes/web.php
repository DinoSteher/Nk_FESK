<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Landing page
Route::get('/', ['as' => 'home', 'uses' => 'Users\DashboardController@index']);

// Authorization
Route::get('/login', ['as' => 'auth.login.form', 'uses' => 'Auth\SessionController@getLogin']);
Route::post('/login', ['as' => 'auth.login.attempt', 'uses' => 'Auth\SessionController@postLogin']);
Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\SessionController@getLogout']);

// Registration
//Route::get('register', ['as' => 'auth.register.form', 'uses' => 'Auth\RegistrationController@getRegister']);
//Route::post('register', ['as' => 'auth.register.attempt', 'uses' => 'Auth\RegistrationController@postRegister']);

// Activation
//Route::get('activate/{code}', ['as' => 'auth.activation.attempt', 'uses' => 'Auth\RegistrationController@getActivate']);
//Route::get('resend', ['as' => 'auth.activation.request', 'uses' => 'Auth\RegistrationController@getResend']);
//Route::post('resend', ['as' => 'auth.activation.resend', 'uses' => 'Auth\RegistrationController@postResend']);

// Password Reset
//Route::get('password/reset/{code}', ['as' => 'auth.password.reset.form', 'uses' => 'Auth\PasswordController@getReset']);
//Route::post('password/reset/{code}', ['as' => 'auth.password.reset.attempt', 'uses' => 'Auth\PasswordController@postReset']);
Route::get('password/reset', ['as' => 'auth.password.request.form', 'uses' => 'Auth\PasswordController@getRequest']);
Route::post('password/reset', ['as' => 'auth.password.request.attempt', 'uses' => 'Auth\PasswordController@postRequest']);

// Dashboard
Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Users\DashboardController@index']);
Route::get('teams/{id}', ['as'=> 'team', 'uses' => 'Users\TeamController@index']);
Route::get('players/{id}',['as'=>'player', 'uses'=>'Users\PlayerController@show']);
Route::get('documents', ['as'=> 'documents', 'uses' => 'Users\DocumentController@index']);
Route::get('articles', ['as'=> 'articles', 'uses' => 'Users\ArticleController@index']);
Route::get('articles/{id}', ['as'=>'article', 'uses'=>'Users\ArticleController@show']);
Route::get('contact', ['as'=>'contact', 'uses'=>'Users\ContactController@index']);




/*############# ADMIN ##############*/
Route::group(['prefix' => 'admin'], function () {
  // Dashboard
  Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);
  // Users
  Route::resource('users', 'Admin\UserController');
  // Roles
  Route::resource('roles', 'Admin\RoleController');
  // Teams
  Route::resource('teams', 'Admin\TeamsController');
  // Players
  Route::resource('players', 'Admin\PlayersController');
  // Documents
  Route::resource('documents', 'Admin\DocumentsController');
  // Articles
  Route::resource('articles', 'Admin\ArticlesController');
  //Gallery
  Route::resource('gallery', 'Admin\GalleryController');
});
