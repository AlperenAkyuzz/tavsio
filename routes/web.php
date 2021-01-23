<?php use Illuminate\Support\Facades\Route;

/***
 *  tavsiocms panel ekranlari
 */
Route::get('mailSend', 'CronController@mailSend');
// Route::get('imageconverter/{pathkey}/{filename}/{w?}/{h?}','Frontend\ImageController@image');

Route::get('tavsiocms', 'Cms\LoginController@login');
Route::get('tavsiocms/login', 'Cms\LoginController@login');
Route::post('tavsiocms/loginproccess', 'Cms\LoginController@login_process');

/***
 * panel yetkisi olan kullanicilar
 */

Route::group(['prefix' => 'tavsiocms', 'middleware' => 'admin'], function () {
    Route::get('/', 'Cms\DashboardController@index');
    Route::get('logout', 'Cms\LoginController@logout');

    // Lesson Categories
    Route::group(['prefix' => 'lessons-categories'], function () {
        Route::get('/', 'Cms\Categories\CategoriesController@categories');
        Route::post('add', 'Cms\Categories\CategoriesController@categoryAdd');
        Route::post('edit', 'Cms\Categories\CategoriesController@categoryEdit');
        Route::post('delete', 'Cms\Categories\CategoriesController@deleteCategory');
        Route::get('ordering-category', 'Cms\Categories\CategoriesController@orderingCategory');
    });

    Route::post('categories/get-category', 'Cms\Categories\CategoriesController@getCategory');
    Route::get('categories', 'Cms\Categories\CategoriesController@categories');
    Route::post('categories/child-category', 'Cms\Categories\CategoriesController@childsCategory');

    // Region
    Route::group(['prefix' => 'region'], function () {

        // Cities
        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', 'Cms\Region\CitiesController@index');
            Route::post('/', 'Cms\Region\CitiesController@citiesDatatable');
            Route::get('add', 'Cms\Region\CitiesController@add');
            Route::post('add', 'Cms\Region\CitiesController@add');
            Route::post('remove', 'Cms\Region\CitiesController@remove');
            Route::get('edit/{uuid}', 'Cms\Region\CitiesController@edit');
            Route::post('edit/{uuid}', 'Cms\Region\CitiesController@edit');
        });

        // Districts
        Route::group(['prefix' => 'districts'], function () {
            Route::get('/', 'Cms\Region\DistrictsController@index');
            Route::post('/', 'Cms\Region\DistrictsController@districtsDatatable');
            Route::get('add', 'Cms\Region\DistrictsController@add');
            Route::post('add', 'Cms\Region\DistrictsController@add');
            Route::post('remove', 'Cms\Region\DistrictsController@remove');
            Route::get('edit/{uuid}', 'Cms\Region\DistrictsController@edit');
            Route::post('edit/{uuid}', 'Cms\Region\DistrictsController@edit');
        });

        // Places
        Route::group(['prefix' => 'places'], function () {
            Route::get('/', 'Cms\Region\PlacesController@index');
            Route::post('/', 'Cms\Region\PlacesController@placesDatatable');
            Route::get('add', 'Cms\Region\PlacesController@add');
            Route::post('add', 'Cms\Region\PlacesController@add');
            Route::post('remove', 'Cms\Region\PlacesController@remove');
            Route::get('edit/{uuid}', 'Cms\Region\PlacesController@edit');
            Route::post('edit/{uuid}', 'Cms\Region\PlacesController@edit');
        });
    });

    // Pages
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', 'Cms\Pages\PagesController@index');
        Route::post('ajax', 'Cms\Pages\PagesController@pagesDatatable');
        Route::get('add', 'Cms\Pages\PagesController@add');
        Route::post('add', 'Cms\Pages\PagesController@add');
        Route::get('edit/{uuid}', 'Cms\Pages\PagesController@edit');
        Route::post('edit/{uuid}', 'Cms\Pages\PagesController@edit');
        Route::post('remove', 'Cms\Pages\PagesController@remove');

        // Pages Categories
        Route::get('categories', 'Cms\Pages\PagesCategoryController@index');
        Route::post('categories-ajax', 'Cms\Pages\PagesCategoryController@categoryDatatable');
        Route::get('category-add', 'Cms\Pages\PagesCategoryController@add');
        Route::post('category-add', 'Cms\Pages\PagesCategoryController@add');
        Route::get('category-edit/{uuid}', 'Cms\Pages\PagesCategoryController@edit');
        Route::post('category-edit/{uuid}', 'Cms\Pages\PagesCategoryController@edit');
        Route::post('category-remove', 'Cms\Pages\PagesCategoryController@remove');
    });

    //Site Settings
    Route::group(['prefix' => 'site'], function () {
        //Site settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'Cms\Site\SiteController@indexSettings');
            Route::post('edit', 'Cms\Site\SiteController@editSettings');
        });
        //Site contact
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', 'Cms\Site\SiteController@indexContact');
            Route::post('edit', 'Cms\Site\SiteController@editContact');
        });
        //Site social
        Route::group(['prefix' => 'social'], function () {
            Route::get('/', 'Cms\Site\SiteController@indexSocial');
            Route::post('edit', 'Cms\Site\SiteController@editSocial');
        });
        //Site mail template
        Route::group(['prefix' => 'mail-template'], function () {
            Route::get('/', 'Cms\Site\SiteController@indexMailTemplate');
            Route::post('ajax', 'Cms\Site\SiteController@mailTemplateDatatable');
            Route::get('add', 'Cms\Site\SiteController@addMailTemplate');
            Route::post('add', 'Cms\Site\SiteController@addMailTemplate');
            Route::get('edit/{uuid}', 'Cms\Site\SiteController@editMailTemplate');
            Route::post('edit/{uuid}', 'Cms\Site\SiteController@editMailTemplate');
            Route::post('remove', 'Cms\Site\SiteController@removeMailTemplate');
        });
    });
});

// =========================================================================================================

/***
 *  Frontend Routes
 */
Route::get('/', 'Frontend\DashboardController@index')->name('index');

/**
 * User Routes
 */
Route::get('giris', 'Frontend\User\LoginController@index')->name('login');
Route::post('login', 'Frontend\User\LoginController@login_process');
Route::get('cikis', 'Frontend\User\LoginController@logout')->name('logout');

Route::get('hesabim', 'Frontend\User\MyProfileController@index')->middleware('auth')->name('profile');
Route::get('hesabim/duzenle', 'Frontend\User\MyProfileController@edit')->middleware('auth')->name('profileEdit');
Route::get('addFollow/{username}', 'Frontend\User\ProfileController@addFollow')->middleware('auth');
Route::get('unFollow/{username}', 'Frontend\User\ProfileController@unFollow')->middleware('auth');
Route::get('arkadaslar/', 'Frontend\User\ProfileController@getFriends')->middleware('auth');
/*
Route::get('/register', function () {
    $insert = [
        'uuid'            => \Webpatser\Uuid\Uuid::generate()->string,
        'typeid'          => 1,
        'username'        => 'alperenakyuz',
        'firstname'       =>"Alperen",
        'lastname'        => "Akyüz",
        'email'           => "alperenakyuz@yandex.com",
        'password'        => bcrypt("serv1693")
    ];
    $userInsertId = DB::table('users')->insertGetId($insert);
});*/

/**
 * Post Routes
 */
Route::get('posts', 'Frontend\Post\PostController@index');
Route::get('test', 'Frontend\Post\PostController@test');
Route::post('store', 'Frontend\Post\PostController@store');

Route::get('{slug}', 'Frontend\RedirectController@index');
