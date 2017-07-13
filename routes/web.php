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
Auth::routes();
#Route::get('/admin/home', 'HomeController@index');
Route::get('logout', ['as' => 'logout', 'uses' => '\App\Http\Controllers\Auth\LoginController@logout']);


Route::get('/', function () {
    return view('auth.login');
});


Route::get('/', [
    'as'   => 'front.index',
    'uses' => 'FrontController@index',
]);

/* Route::get('article/{id}', [
    'uses' => 'FrontController@viewContent',
    'as'   => 'front.article.content',
]); */


Route::get('categories/{name}', [
    'uses' => 'FrontController@searchCategory',
    'as'   => 'front.search.category',
]);


Route::get('tags/{name}', [
    'uses' => 'FrontController@searchTag',
    'as'   => 'front.search.tag',
]);


Route::get('articles/{slug}', [
    'uses' => 'FrontController@viewArticle',
    'as'   => 'front.view.article',
]);

Route::get('login', [
    'uses' => 'FrontController@showLogin',
    'as'   => 'login',
]);

Route::post('register', [
    'uses' => 'FrontController@registerUser',
    'as'   => 'register'
]);

/*Route::group(['prefix' => 'articles'], function (){
    Route::get('view/{article?}', function ($article = "Empty"){
        echo $article;
    });

    Route::get('view/{id}', ['uses' => 'TestController@view',
                             'as' => 'articlesView']);
});*/


/**     ===== RUTAS DEL PROYECTO =====     **/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){

    Route::group(['middleware' => 'admin'], function (){

        Route::get('home', [
                'uses' => 'HomeController@index',
                'as'   => 'admin.home']
        );

        Route::resource('users', 'UsersController');

        Route::get('users/{id}/destroy', [
            'uses' => 'UsersController@destroy',
            'as' => 'users.destroy'
        ]);
    });

    Route::get('profile', [
        'uses' => 'HomeController@profile',
        'as'   => 'admin.profile'
    ]);

    Route::post('infoupdate/{id}', [
        'uses' => 'HomeController@updateInfo',
        'as'   => 'admin.infoupdate'
    ]);

    Route::post('passupdate/{id}', [
        'uses' => 'HomeController@changePass',
        'as'   => 'admin.passupdate'
    ]);


    Route::resource('categories', 'CategoriesController');

    Route::get('categories/{id}/destroy', [
        'uses' => 'CategoriesController@destroy',
        'as' => 'categories.destroy'
    ]);


    Route::resource('tags', 'TagsController');

    Route::get('tags/{id}/destroy', [
        'uses' => 'TagsController@destroy',
        'as' => 'tags.destroy'
    ]);


    Route::resource('articles', 'ArticlesController');

    Route::get('articles/{id}/destroy',[
        'uses' => 'ArticlesController@destroy',
        'as' => 'articles.destroy'
    ]);

    Route::get('images', [
        'uses' => 'ImageController@index',
        'as' => 'images.index'
    ]);

    Route::post('send', [
        'as' => 'send',
        'uses' => 'MailController@send'
    ]);

    Route::get('contact', [
        'uses' => 'MailController@index',
        'as'   => 'contact'
    ]);
});



