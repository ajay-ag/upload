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

Route::get('/', function () {
    return view('website.index');
});

Route::get('/symbolic-link', function () {
  Artisan::call('storage:link');
  echo 'Link created successfully.';
});

Route::get('/db-migration', function () {
  Artisan::call('migrate');
  echo 'Migrated successfully.';
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    echo 'All clear done successfully.';
});

Route::post('common_check_exist', 'Controller@common_check_exist')->name('common_check_exist');
Route::get('cront_for_expired', 'Controller@cronForExpired')->name('cron-for-expired');

Route::get('get-city-for-post' , 'Controller@cityForPost')->name('cityForPost');


Route::group(['namespace' => 'Front'], function () {
    Route::post('register/exits', 'LoginController@check')->name('register.check');
    Route::get('/', 'HomeController@index')->name('home_auth');
    Route::resource('contactus', 'ContactUsController');
    Route::get('privancy-policy', 'ContactUsController@privancy');
    Route::get('terms-and-conditions', 'ContactUsController@termsAndConditions');
    Route::post('/contactseller', 'AdvertiseController@contact_seller')->name('contact-seller');

    //use for before login
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'LoginController@login');
        Route::post('/login', 'LoginController@loginUser')->name('users.login');
        Route::get('/otp-verify', 'LoginController@otpVerifyView')->name('users.otp.verify');
        Route::get('/otp-resend', 'LoginController@OtpResend')->name('users.otp.resend')->middleware('throttle:2,1');

        Route::post('/otp-verify', 'LoginController@otpVerify')->name('users.otp.verify.now');
        Route::get('/register', 'LoginController@register');
        Route::post('/register', 'LoginController@registerUser')->name('users.register');

        Route::get('/reset-password', 'LoginController@resetView')->name('users.reset.view');
        Route::get('/reset-otp-password', 'LoginController@resetOtpView')->name('users.otp.view');
        Route::post('/forgotUser', 'LoginController@forgotUser')->name('users.reset.forgotUser');
        Route::post('/otp-verify-reset', 'LoginController@otpVerifyReset')->name('users.otp.verify.reset');
        Route::get('/set-reset-password', 'LoginController@setResetPassword')->name('set.reset.password');
        Route::post('/set-reset-password-save', 'LoginController@setResetPasswordSave')->name('set.reset.password.save');
    });

    Route::get('/select2cityHomepage', 'ProfileController@select2StateHomePage')->name('select2cityHomepage');
//for login user access
    Route::get('/card/{id}/{name?}', 'LoginController@myCard')->name('my_card');
    Route::group(['middleware' => 'is_user'], function () {

        //user related
        Route::get('/business-card', 'LoginController@businessCard');
        Route::post('/business-card-set', 'LoginController@businessCardSet')->name('business_card_set');

        Route::get('/user/change-password', 'LoginController@changePassword');
        Route::post('/change-status', 'LoginController@changeStatus')->name('privacy.change');
        Route::post('/change-password-set', 'LoginController@changePasswordSet')->name('set.password');
        Route::get('/user/profile', 'ProfileController@profile')->name('profile.front');
        Route::post('/profile-set', 'ProfileController@profileSet')->name('profile.set');
        Route::post('/getCitiesByState', 'ProfileController@getCitiesByState')->name('getCitiesByState');
        Route::get('/select2StatePersonal', 'ProfileController@select2StatePersonal')->name('select2StatePersonal');
        Route::get('/select2Country', 'ProfileController@getCountry')->name('select2Country');

        //user post create,edit,list,image upload
        Route::get('/user/dashboard', 'DashboardController@index');

        Route::get('/user/post', 'AdvertisementPostController@index')->name('user.list');
        Route::post('user/post/datalist', 'AdvertisementPostController@dataList')->name('user.post.list');
        Route::get('/user/create-post', 'AdvertisementPostController@createPost')->name('add.post');
        Route::get('/user/edit-post/{id}', 'AdvertisementPostController@editPost')->name('edit.post');
        Route::post('/create-post-set', 'AdvertisementPostController@setPost')->name('set.post');
        Route::get('/post-image/{id}', 'AdvertisementPostController@image')->name('post.image');
        Route::get('/post-image-delete/{id}', 'AdvertisementPostController@galleryDestroy')->name('user.image.delete');
        Route::get('/user/my-favourite', 'AdvertisementPostController@postMyFavouriteList')->name('post.my.favourite.list');
        Route::post('/user/post-image-position/{id}', 'AdvertisementPostController@positionImage')->name('gallery.image.position');
        Route::get('/post-image-position-final', 'AdvertisementPostController@imageSaveFinal')->name('gallery.image.final');

        Route::delete('/post-image-destroy/{id}', 'AdvertisementPostController@destroy')->name('post.destroy');

        Route::get('/post-image-solved/{id}', 'AdvertisementPostController@solved')->name('post.solved');
        Route::post('/create-post-image', 'AdvertisementPostController@imageStore')->name('create.post.image');
        Route::post('/create-post-update', 'AdvertisementPostController@updatePost')->name('update.post');
        Route::post('/getsub-category', 'AdvertisementPostController@getSubCategory')->name('user.subcategory');
        Route::post('/getsub-category-post-attribute', 'AdvertisementPostController@userPostAttribute')->name('user.post.attribute');
        Route::get('/user/my-lead', 'AdvertisementPostController@myLead')->name('post.my.lead.list');
        Route::post('/user/lead/datalist', 'AdvertisementPostController@LeadDatalist')->name('user.lead.datalist');

        //user chat
        Route::get('/messages/{id?}/{post_slug?}', 'MessagesController@create_message')->name('messages.create');
        Route::post('/messages-send', 'MessagesController@send_message')->name('messages-send');
        Route::post('/online_users', 'MessagesController@online_user_list');

    });


    Route::get('/logout', 'LoginController@logoutUser')->name('users.logout');

    Route::get('/category', 'CategoryController@index');
    Route::get('/listing-grid', 'HomeController@listingGrid');
    Route::get('/advertise', 'AdvertiseController@index')->name('advertise');
    Route::get('/set-favourit/{id}', 'AdvertiseController@setFavourit')->name('set-favourit');
    Route::post('/advertise/post/filter', 'AdvertiseController@dataListing')->name('advertise-filter');
    Route::get('/advertise/post/filter', 'AdvertiseController@dataListing')->name('advertise-filter');
    Route::get('/advertise/{slug}', 'AdvertiseController@datalisting');


    Route::get('/advertise/sub-category/{slug}', 'AdvertiseController@datalisting');
    Route::get('/advertise/category/{category_slug}', 'AdvertiseController@datalisting');


    Route::get('/advertise_detail/{slug?}', 'AdvertiseController@advertise_detail')->name('advertise-detail');
    Route::get('/advertise_detail/view/{admin_slug?}', 'AdvertiseController@advertise_detail')->name('advertise-admin-view');


    Route::get('/listing-grid-single', 'HomeController@listingGridSingle');
    Route::resource('about', 'AboutusController');

    Route::resource('service', 'ServiceController');
    Route::get('service-details/{id}', 'ServiceController@show')->name('service.details');
    Route::resource('newsletter', 'NewsletterController');

    Route::post('/subscribe/email/check', 'NewsletterController@checkMail')->name('newsletter.email.check');


});





// ----------------------------Admin Auth---------------------------------------------------------
Route::get('/admin', 'AdminAuth\LoginController@showLoginForm');
Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::post('/email/check', 'AdminAuth\LoginController@emailCheck');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');




});
