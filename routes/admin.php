<?php

//------------------------------Admin Route-----------------------------------------------//
Route::namespace('Admin')->group(function () {

//Dashboard
      // Route::resource('dashboard', 'HomeController');
       Route::get('dashboard', 'AdminHomeController@index')->name('dashboard');

//Profile and Change Password

       Route::get('/profile-overview','ProfileController@overviewIndex')->name('overview.index');
       Route::get('/profile','ProfileController@index')->name('profile.index');
       Route::get('/profile-change-password','ProfileController@changepasswordIndex')->name('change-password.index');

       Route::post('/profile/change','ProfileController@profileChange')->name('profile.change');
       Route::post('/password/change','ProfileController@passwordChange')->name('password.change');
       Route::post('/change/image/{id}','ProfileController@changeProfilImage')->name('changeProfilImage');

           //Services
    Route::resource('services', 'ServiceController');
    Route::post('services/list', 'ServiceController@dataListing')->name('services.list');
    Route::post('services/status', 'ServiceController@changeStatus')->name('services.status');
    Route::post('services/exits', 'ServiceController@check')->name('services.check');
    Route::post('services/update/exits', 'ServiceController@checkupdate')->name('services.check.update');


    //post Attribute
    Route::resource('post-attribute', 'PostAttributeController');
    Route::post('post-attribute/list', 'PostAttributeController@dataListing')->name('post-attribute.list');
    Route::post('get-sub-category', 'PostAttributeController@getSubCategory')->name('postattribute.getsubcategory');
    Route::post('post-attribute-relation', 'PostAttributeController@relation')->name('post.attribute.relation');


    //Newsletter
    Route::resource('newsletter', 'NewsletterController');
    Route::post('newsletter/list', 'NewsletterController@dataListing')->name('newsletter.list');

    //Slider
    Route::post('bannder/list', 'HomepagebannerController@dataListing')->name('bannder.list');
    Route::post('bannder/status', 'HomepagebannerController@changeStatus')->name('homepagebanners.status');
    Route::resource('homepagebanners', 'HomepagebannerController');

    //Mail Setup
    Route::resource('mailsetup', 'MailsetupController');


    //--- Category
    Route::resource('category', 'CategoryController');
    Route::post('category/list', 'CategoryController@dataListing')->name('category.list');
    Route::post('category/status', 'CategoryController@changeStatus')->name('category.status');

    //--- Sub Category
    Route::resource('subcategory', 'SubcategoryController');
    Route::post('subcategory/list', 'SubcategoryController@dataListing')->name('subcategory.list');
    Route::post('subcategory/status', 'SubcategoryController@changeStatus')->name('subcategory.status');


    //brand
    Route::resource('brand', 'BrandController');
    Route::post('brand/list', 'BrandController@dataListing')->name('brand.list');
    Route::post('brand/status', 'BrandController@changeStatus')->name('brand.status');
    Route::post('brand/exits', 'BrandController@check')->name('brand.check');
    Route::post('bbrand/update/exits', 'BrandController@checkupdate')->name('brand.check.update');

    Route::resource('post-remark', 'PostRemarkController');
    Route::post('post-remark/list', 'PostRemarkController@dataListing')->name('post-remark.list');

    // Static pages
    Route::resource('staticpages', 'StaticpagesController');
    Route::post('staticpages/list', 'StaticpagesController@dataListing')->name('staticpages.list');
    Route::post('staticpages/status', 'StaticpagesController@changeStatus')->name('staticpages.status');


    //User
    Route::resource('site-user', 'SiteuserController');
    Route::post('site-user/list', 'SiteuserController@dataListing')->name('site_user.list');
    Route::post('site-user/status', 'SiteuserController@changeStatus')->name('site_user.status');
    Route::get('site-user/user/name', 'SiteuserController@getSiteUser')->name('get.user.name');
    Route::get('site-user/user/city', 'SiteuserController@getUserCity')->name('get.user.city');

    //Post
    Route::resource('post', 'PostUserController');
    Route::post('post/list', 'PostUserController@dataListing')->name('post_user.list');
     Route::get('remarkView/{id}', 'PostUserController@remarkView')->name('post_user.remarkView');


    //Contact us
    Route::resource('contact', 'ContactUsController');
    Route::post('contact/list', 'ContactUsController@dataListing')->name('contactus.list');

    //Setting
    Route::resource('settings', 'SettingController');
    Route::get('setting/home-seo', 'SettingController@create')->name('homeseo.create');
    Route::post('setting/home-seo-edit/{id}', 'SettingController@update')->name('homeseo.update');

    //about
    Route::resource('about', 'AboutusController');

    //for gallery
    Route::resource('gallery', 'GalleryController');
    Route::post('gallery/list', 'GalleryController@dataListing')->name('gallery.list');
    Route::post('gallery/status', 'GalleryController@changeStatus')->name('gallery.status');

    //Package
    Route::resource('plan','PlanController');
    Route::post('plan/datalist', 'PlanController@datalist')->name('plan.list');
    Route::post('plan/status/{id}','PlanController@changestatus')->name('plan.status');
    Route::post('/plan/checkPlan', 'PlanController@checkPlan')->name('checkPlan');



});

// Settings Routes
Route::namespace('Admin')->group(function () {
    Route::get('f/country', 'SerchController@getCountry')->name('get.country');
    Route::get('f/state', 'SerchController@getState')->name('get.state');
    Route::get('f/city', 'SerchController@getCity')->name('get.city');
    Route::get('f/category', 'SerchController@getCategory')->name('get.category');
    Route::get('f/series', 'SerchController@getSeries')->name('get.series');

});


