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

//Clear configurations:
Route::get('/config-clear', function() {
    $status = Artisan::call('config:clear');
    return '<h1>Configurations cleared</h1>';
});

// Route::get('/test', function() {
//     return view('emails.aktifasireg');
// });



//Clear cache:
Route::get('/session-clear', function() {
    $status = Artisan::call('session:clear');
    return '<h1>Cache cleared</h1>';
});

//Clear configuration cache:
Route::get('/config-cache', function() {
    $status = Artisan::call('config:Cache');
    return '<h1>Configurations cache cleared</h1>';
});
Route::get('/login/logOutUser', 'Auth\LoginController@logOutUser')->name('compro.logOutUser');

Route::get('/login/google', 'Auth\LoginController@redirectToProvider')->name('compro.google');
Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');



// Route::get('/login/facebook', 'AdminLoginController@index');
// Route::get('/login/facebook', 'AdminLoginController@redirectToProvider');
// Route::get('/login/facebook/callback', 'AdminLoginController@handleProviderCallback');
// http://localhost:8000/login/google/callback/
// Compro NEW
Route::get('/testMail', 'NewComproController@testMail')->name('compro.testMail');
Route::get('/media-center', 'NewComproController@mediaCenter')->name('compro.mediaCenter');
Route::get('/media-center/{id}/{url}', 'NewComproController@mediaCenterOne')->name('compro.mediaCenterOne');
Route::get('/about', 'NewComproController@about')->name('compro.about');
Route::get('/management', 'NewComproController@management')->name('compro.management');
Route::get('/managementChoose/{id}', 'NewComproController@managementSingle')->name('compro.managementSingle');
Route::get('/contact-us', 'NewComproController@contact')->name('compro.contact');
Route::post('/sendMailOnContact', 'NewComproController@sendMailOnContact')->name('compro.sendMailOnContact');

Route::post('/sendMail', 'NewComproController@sendMail')->name('compro.sendMail');

Route::get('/career/{position}/{id}', 'NewComproController@karirOne')->name('compro.careerOne');
Route::get('/trainingNext/{id}', 'NewComproController@trainingNext')->name('compro.trainingNext');
Route::get('/trainingPrev/{id}', 'NewComproController@trainingPrev')->name('compro.trainingPrev');

Route::get('/training/{id}', 'NewComproController@training')->name('compro.training');

Route::get('/trainingRegister', 'NewComproController@registerTrain')->name('compro.registerTrain');

Route::post('/trainingRegister/regis', 'NewComproController@trainRegis')->name('compro.trainRegis');

Route::get('/trainingRegister/regisSummary', 'NewComproController@regisSummary')->name('compro.regisSummary');

Route::get('/trainingRegister/regisProcees', 'NewComproController@regisProcees')->name('compro.regisProcees');

Route::get('/trainingRegister/regisProceedSum', 'NewComproController@regisProceedSum')->name('compro.regisProceedSum');

// FOR REANDA
Route::get('/about-us', 'NewComproController@AboutUs')->name('compro.AboutUs');
Route::get('/thought-leaders', 'NewComproController@TL')->name('compro.TL');
Route::get('/our-core-values', 'NewComproController@ocv')->name('compro.ocv');

Route::get('/reanda-international', 'NewComproController@reandaInternational')->name('compro.reandaInternational');
Route::get('/chariman-message', 'NewComproController@charimanmessage')->name('compro.charimanmessage');
Route::get('/thought-leaders', 'NewComproController@TL')->name('compro.TL');
Route::get('/thought-leaders/profile/{id}', 'NewComproController@TLOne')->name('compro.TLOne');

// LIST SERVICES

Route::get('/servicesList/', 'NewComproController@servLists')->name('compro.servLists'); //added
Route::get('/services/list/{id}', 'NewComproController@serviceListId')->name('compro.servListId');
Route::get('/services/list/sub/{id}', 'NewComproController@serviceSub')->name('compro.servSub');
Route::get('/services/contact/{id}/{sername}', 'NewComproController@serviceContact')->name('compro.servCon');
Route::post('/sendMailOnContactServ', 'NewComproController@sendMailOnContactServ')->name('compro.sendMailOnContactServ');


    // GLOBAL OFFICE DIRECTORY
    /*Route::get('/admin/office', 'AdminOfficeController@index')->name('office');
    Route::get('/admin/office/add', 'AdminOfficeController@add')->name('office.add');
    Route::post('/admin/office/store', 'AdminOfficeController@store')->name('office.store');
    Route::get('/admin/office/edit/{id}', 'AdminOfficeController@edit')->name('office.edit');
    Route::post('/admin/office/update/{id}', 'AdminOfficeController@update')->name('office.update');
    Route::get('/admin/office/delete/{id}', 'AdminOfficeController@delete')->name('office.delete');*/


Route::get('/audit-&-assurance/', 'NewComproController@servAuditAss')->name('compro.servAuditAss');
Route::get('/audit-&-assurance/financial-accounting-audits-&-reviews', 'NewComproController@servAuditAss_review')->name('compro.servAuditAss_review');
Route::get('/audit-&-assurance/financial-accounting-advisory', 'NewComproController@servAuditAss_advisory')->name('compro.servAuditAss_advisory');
Route::get('/audit-&-assurance/accounts-outsourcing', 'NewComproController@servAuditAss_outsourcing')->name('compro.servAuditAss_outsourcing');


Route::get('/accounting-advisory-services/', 'NewComproController@servAccount')->name('compro.servAccount');
Route::get('/capital-market-services/', 'NewComproController@servCapital')->name('compro.servCapital');
Route::get('/china-business-desk/', 'NewComproController@servChina')->name('compro.servChina');
Route::get('/consulting/', 'NewComproController@servConsul')->name('compro.servConsul');

Route::get('/consulting/change-management', 'NewComproController@servConsul_change')->name('compro.servConsul_change');
Route::get('/consulting/performance-improvement', 'NewComproController@servConsul_performance')->name('compro.servConsul_performance');
Route::get('/consulting/enterprise-risk-management', 'NewComproController@servConsul_enter')->name('compro.servConsul_enter');

Route::get('/entrepreneurial-services/', 'NewComproController@servEntrep')->name('compro.servEntrep');
Route::get('/fraud-services/', 'NewComproController@servFraud')->name('compro.servFraud');
Route::get('/japan-business-desk/', 'NewComproController@servJapan')->name('compro.servJapan');
Route::get('/merge-&-acquisitions/', 'NewComproController@servMA')->name('compro.servMA');
Route::get('/tax/', 'NewComproController@servTax')->name('compro.servTax');
Route::get('/technology-and-operations-services/', 'NewComproController@servTecho')->name('compro.servTecho');

// LIST INDUSTRIES
Route::get('/government-entertainment-and-non-profit/', 'NewComproController@indusGov')->name('compro.indusGov');
Route::get('/financial-services/', 'NewComproController@indusFinan')->name('compro.indusFinan');
Route::get('/energy-utilities-and-mining/', 'NewComproController@indusEnergy')->name('compro.indusEnergy');
Route::get('/consumer-industrial-products-and-services/', 'NewComproController@indusCons')->name('compro.indusCons');
Route::get('/telecommunications-media-and-technology/', 'NewComproController@indusTel')->name('compro.indusTel');

// LIST PUBLICATIONS
Route::get('/publications/', 'NewComproController@publications')->name('compro.publications');
Route::get('/annual-review/', 'NewComproController@pubAn')->name('compro.pubAn');
Route::get('/country-report/', 'NewComproController@pubCon')->name('compro.pubCon');
Route::get('/doing-business/', 'NewComproController@pubDB')->name('compro.pubDB');
Route::get('/prims-newsletter/', 'NewComproController@pubPrim')->name('compro.pubPrim');
Route::get('/tax-year-book/', 'NewComproController@pubTax')->name('compro.pubTax');


// CAREER
Route::get('/career', 'NewComproController@career')->name('compro.career');
Route::post('/career/search', 'NewComproController@careerFinded')->name('compro.careerFinded');
// Route::post('career/pencarian', 'NewComproController@career')->name('compro.pencarian');
Route::get('/career-meet-our-people', 'NewComproController@careerMeet')->name('compro.career.meet');
Route::get('/career-faq', 'NewComproController@careerFaq')->name('compro.career.faq');

Route::get('/meet-our-people', 'NewComproController@meetOur')->name('compro.meetOur');
Route::get('/meet-our-people/nadya', 'NewComproController@meetNadya')->name('compro.meetNadya');
Route::get('/meet-our-people/stephanie', 'NewComproController@meetStep')->name('compro.meetStep');
Route::get('/meet-our-people/aditya', 'NewComproController@meetAdit')->name('compro.meetAdit');
Route::get('/meet-our-people/detail/{id?}', 'AdminMeetPeopleController@detail')->name('meet.people.detail');

Route::get('service', 'NewComproController@service')->name('compro.service');
Route::post('subscribed', 'NewComproController@subscribed')->name('compro.subscribed');

//Compro
Route::get('/visi', 'NewComproController@visi')->name('compro.visi');
Route::get('/tentang-kami', 'NewComproController@tentangkami')->name('compro.tentangkami');
Route::get('/tata-kelola/{url}', 'NewComproController@tatakelola')->name('compro.tatakelola');
Route::get('/hubungan-investor/{url}', 'NewComproController@hubunganinves')->name('compro.hubunganinves');
Route::get('/halaman/{id}/{url}', 'NewComproController@hal')->name('compro.hal');
Route::post('/pencarian', 'NewComproController@pencarian')->name('compro.pencarian');
Route::get('/mencari/{string}', 'NewComproController@mencari')->name('compro.mencari');


Route::get('/lang/in', 'NewComproController@langIn')->name('compro.in');
Route::get('/lang/en', 'NewComproController@langEn')->name('compro.en');


// Route::get('/', 'NewComproController@index')->name('compro.home');
// Route::get('/{lang}', 'NewComproController@index')->name('compro.home');


Route::group(['prefix' => 'marketplace'], function() {
//Marketplace
Route::get('/', 'HomeController@home')->name('welcome');
Route::post('/home/search', 'HomeController@homesearch')->name('home.search');
Route::get('/tentang-kami', 'HomeController@tentangkami')->name('tentang.kami');
Route::get('/hubungi-kami', 'HomeController@hubungikami')->name('hubungi.kami');
Route::post('/send/hubungikami', 'HomeController@sendhubungikami')->name('send.hubungikami');
Route::get('/car/detail/{id}', 'HomeController@cardetail')->name('car.detail');
Route::post('/send/dealer/hubungikami', 'HomeController@senddealerhubungikami')->name('senddealer.hubungikami');
Route::post('/car/search', 'HomeController@carsearch')->name('car.search');
Route::post('/car/bid', 'HomeController@bidding')->name('car.bid');
Route::post('/car/hubungikami', 'HomeController@carshubungikami')->name('car.hubungikami');
Route::get('/dealer/profile/{id}', 'HomeController@cardealer')->name('car.dealer');
Route::get('/category/car/{id}', 'HomeController@categorycar')->name('car.category');
Route::post('/send/subscribe', 'HomeController@Sendsubscribe')->name('send.subscribe');
Route::post('/post/postmodel', 'HomeController@PostModel')->name('post.postmodel');
Route::post('/post/postmodelsearch', 'HomeController@PostModelSearch')->name('post.postmodelsearch');

Route::get('/emailregistrasi', 'HomeController@emailregistrasi')->name('emailregistrasi');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'admin']], function() {

    // DELETE FILE ATTACHMENT
    Route::get('/attachment/delete/{id?}', 'AdminServicesController@deleteAttachment')->name('attachment.delete');


    Route::get('/admin/home/{lang?}', 'HomeController@index')->name('home');

    Route::get('/admin/dashboard', 'HomeController@dashboard')->name('dashboard');

// ---------------------------------------------------------------------------------------------------


    // GLOBAL OFFICE DIRECTORY
    Route::get('/admin/office', 'AdminOfficeController@index')->name('office');
    Route::get('/admin/office/add', 'AdminOfficeController@add')->name('office.add');
    Route::post('/admin/office/store', 'AdminOfficeController@store')->name('office.store');
    Route::get('/admin/office/edit/{id}', 'AdminOfficeController@edit')->name('office.edit');
    Route::post('/admin/office/update/{id}', 'AdminOfficeController@update')->name('office.update');
    Route::get('/admin/office/delete/{id}', 'AdminOfficeController@delete')->name('office.delete');

    Route::get('/admin/office/detail/{id}', 'AdminOfficeController@detail')->name('office.detail');
    Route::get('/admin/office/detail/{id}/add', 'AdminOfficeController@detail_add')->name('office.detail.add');
    Route::post('/admin/office/detail/{id}/store', 'AdminOfficeController@detail_store')->name('office.detail.store');
    Route::get('/admin/office/detail/editlist/{id}', 'AdminOfficeController@detail_edit')->name('office.detail.edit');
    Route::post('/admin/office/detail/updatelist/{id}', 'AdminOfficeController@detail_update')->name('office.detail.update');
    Route::get('/admin/office/detail/deletelist/{id}', 'AdminOfficeController@detail_delete')->name('office.detail.delete');


    // Fixed Page Kontak Kami
    Route::get('/admin/contact', 'AdminContactController@index')->name('contact');
    Route::post('/admin/contact/update', 'AdminContactController@update')->name('contact.update');



    // Fixed Page Partner
    Route::get('/admin/partner', 'AdminPartnerController@index')->name('partner');
    Route::get('/admin/partner/add', 'AdminPartnerController@add')->name('partner.add');
    Route::post('/admin/partner/store', 'AdminPartnerController@store')->name('partner.store');
    Route::get('/admin/partner/edit/{id}', 'AdminPartnerController@edit')->name('partner.edit');
    Route::post('/admin/partner/update/{id}', 'AdminPartnerController@update')->name('partner.update');
    Route::get('/admin/partner/delete/{id}', 'AdminPartnerController@delete')->name('partner.delete');

    // Fixed Page TESTI
    Route::get('/admin/testi', 'AdminTestiController@index')->name('testi');
    Route::get('/admin/testi/add', 'AdminTestiController@add')->name('testi.add');
    Route::post('/admin/testi/store', 'AdminTestiController@store')->name('testi.store');
    Route::get('/admin/testi/edit/{id}', 'AdminTestiController@edit')->name('testi.edit');
    Route::post('/admin/testi/update/{id}', 'AdminTestiController@update')->name('testi.update');
    Route::get('/admin/testi/delete/{id}', 'AdminTestiController@delete')->name('testi.delete');

    // Fixed Page Partner
    Route::get('/admin/projects', 'AdminProjectsController@index')->name('projects');
    Route::get('/admin/projects/add', 'AdminProjectsController@add')->name('projects.add');
    Route::post('/admin/projects/store', 'AdminProjectsController@store')->name('projects.store');
    Route::get('/admin/projects/edit/{id}', 'AdminProjectsController@edit')->name('projects.edit');
    Route::post('/admin/projects/update/{id}', 'AdminProjectsController@update')->name('projects.update');
    Route::get('/admin/projects/delete/{id}', 'AdminProjectsController@delete')->name('projects.delete');

    // Fixed Pub. Tax Year
    Route::get('/admin/pub-tax', 'AdminPubTaxController@index')->name('pubTax');
    Route::get('/admin/pub-tax/add', 'AdminPubTaxController@add')->name('pubTax.add');
    Route::post('/admin/pub-tax/store', 'AdminPubTaxController@store')->name('pubTax.store');
    Route::get('/admin/pub-tax/edit/{id}', 'AdminPubTaxController@edit')->name('pubTax.edit');
    Route::post('/admin/pub-tax/update/{id}', 'AdminPubTaxController@update')->name('pubTax.update');
    Route::get('/admin/pub-tax/delete/{id}', 'AdminPubTaxController@delete')->name('pubTax.delete');

    // Fixed Pub. PRIMS
    Route::get('/admin/pub-prims', 'AdminPubPrimsController@index')->name('pubPrims');
    Route::get('/admin/pub-prims/add', 'AdminPubPrimsController@add')->name('pubPrims.add');
    Route::post('/admin/pub-prims/store', 'AdminPubPrimsController@store')->name('pubPrims.store');
    Route::get('/admin/pub-prims/edit/{id}', 'AdminPubPrimsController@edit')->name('pubPrims.edit');
    Route::post('/admin/pub-prims/update/{id}', 'AdminPubPrimsController@update')->name('pubPrims.update');
    Route::get('/admin/pub-prims/delete/{id}', 'AdminPubPrimsController@delete')->name('pubPrims.delete');

    // Fixed Pub. Annual Review
    Route::get('/admin/pub-annual', 'AdminPubAnnualController@index')->name('pubAn');
    Route::get('/admin/pub-annual/add', 'AdminPubAnnualController@add')->name('pubAn.add');
    Route::post('/admin/pub-annual/store', 'AdminPubAnnualController@store')->name('pubAn.store');
    Route::get('/admin/pub-annual/edit/{id}', 'AdminPubAnnualController@edit')->name('pubAn.edit');
    Route::post('/admin/pub-annual/update/{id}', 'AdminPubAnnualController@update')->name('pubAn.update');
    Route::get('/admin/pub-annual/delete/{id}', 'AdminPubAnnualController@delete')->name('pubAn.delete');

    // Fixed Pub. Annual Doing Business
    Route::get('/admin/pub-DB', 'AdminPubDBController@index')->name('pubDB');
    Route::get('/admin/pub-DB/add', 'AdminPubDBController@add')->name('pubDB.add');
    Route::post('/admin/pub-DB/store', 'AdminPubDBController@store')->name('pubDB.store');
    Route::get('/admin/pub-DB/edit/{id}', 'AdminPubDBController@edit')->name('pubDB.edit');
    Route::post('/admin/pub-DB/update/{id}', 'AdminPubDBController@update')->name('pubDB.update');
    Route::get('/admin/pub-DB/delete/{id}', 'AdminPubDBController@delete')->name('pubDB.delete');


    // Fixed Pub. Counrty Report
    Route::get('/admin/pub-con', 'AdminPubConController@index')->name('pubCon');
    Route::get('/admin/pub-con/add', 'AdminPubConController@add')->name('pubCon.add');
    Route::post('/admin/pub-con/store', 'AdminPubConController@store')->name('pubCon.store');
    Route::get('/admin/pub-con/edit/{id}', 'AdminPubConController@edit')->name('pubCon.edit');
    Route::post('/admin/pub-con/update/{id}', 'AdminPubConController@update')->name('pubCon.update');
    Route::get('/admin/pub-con/delete/{id}', 'AdminPubConController@delete')->name('pubCon.delete');





    Route::get('/admin/services/page', 'AdminTrainingController@page')->name('services.page');
    Route::post('/admin/services/editpage', 'AdminTrainingController@editpage')->name('services.editpage');

    Route::get('/admin/beranda/page', 'AdminPartnerController@page')->name('beranda.page');
    Route::post('/admin/beranda/editpage', 'AdminPartnerController@editpage')->name('beranda.editpage');




    // Fixed Page About Us
    Route::get('/admin/about', 'AdminAboutController@index')->name('about');
    Route::post('/admin/about/update', 'AdminAboutController@update')->name('about.update');

    // MANAGEMENT
    // Route::get('/admin/management', 'AdminManagementController@index')->name('management');
    // Route::post('/admin/management/update', 'AdminManagementController@update')->name('management.update');
    Route::get('/admin/management', 'AdminManagementController@index')->name('management');
    Route::get('/admin/management/add', 'AdminManagementController@add')->name('management.add');
    Route::post('/admin/management/store', 'AdminManagementController@store')->name('management.store');
    Route::get('/admin/management/edit/{id}', 'AdminManagementController@edit')->name('management.edit');
    Route::post('/admin/management/update/{id}', 'AdminManagementController@update')->name('management.update');
    Route::get('/admin/management/delete/{id}', 'AdminManagementController@delete')->name('management.delete');


    Route::get('/admin/point_about', 'AdminPointAboutController@index')->name('point_about');
    Route::get('/admin/point_about/add', 'AdminPointAboutController@add')->name('point_about.add');
    Route::post('/admin/point_about/store', 'AdminPointAboutController@store')->name('point_about.store');
    Route::get('/admin/point_about/edit/{id}', 'AdminPointAboutController@edit')->name('point_about.edit');
    Route::post('/admin/point_about/update/{id}', 'AdminPointAboutController@update')->name('point_about.update');
    Route::get('/admin/point_about/delete/{id}', 'AdminPointAboutController@delete')->name('point_about.delete');

    // Fixed Page Data Message
    Route::get('/admin/message', 'AdminMessageController@index')->name('message');
    Route::get('/admin/message/delete/{id}', 'AdminMessageController@delete')->name('message.delete');

    // Fixed Page Slider
    Route::get('/admin/slider', 'AdminSliderController@index')->name('slider');
    Route::get('/admin/slider/add', 'AdminSliderController@add')->name('slider.add');
    Route::post('/admin/slider/store', 'AdminSliderController@store')->name('slider.store');
    Route::get('/admin/slider/edit/{id}', 'AdminSliderController@edit')->name('slider.edit');
    Route::post('/admin/slider/update/{id}', 'AdminSliderController@update')->name('slider.update');
    Route::get('/admin/slider/delete/{id}', 'AdminSliderController@delete')->name('slider.delete');
    Route::get('/admin/slider/preview/{id}', 'AdminSliderController@preview')->name('slider.preview');


    // Fixed Page timtrainer
    Route::get('/admin/timtrainer', 'AdminTimTrainerController@index')->name('timtrainer');
    Route::get('/admin/timtrainer/add', 'AdminTimTrainerController@add')->name('timtrainer.add');
    Route::post('/admin/timtrainer/store', 'AdminTimTrainerController@store')->name('timtrainer.store');
    Route::get('/admin/timtrainer/edit/{id}', 'AdminTimTrainerController@edit')->name('timtrainer.edit');
    Route::post('/admin/timtrainer/update/{id}', 'AdminTimTrainerController@update')->name('timtrainer.update');
    Route::get('/admin/timtrainer/delete/{id}', 'AdminTimTrainerController@delete')->name('timtrainer.delete');

    // Fixed Page timmanagement
    Route::get('/admin/timmanagement', 'AdminTimManagementController@index')->name('timmanagement');
    Route::get('/admin/timmanagement/add', 'AdminTimManagementController@add')->name('timmanagement.add');
    Route::post('/admin/timmanagement/store', 'AdminTimManagementController@store')->name('timmanagement.store');
    Route::get('/admin/timmanagement/edit/{id}', 'AdminTimManagementController@edit')->name('timmanagement.edit');
    Route::post('/admin/timmanagement/update/{id}', 'AdminTimManagementController@update')->name('timmanagement.update');
    Route::get('/admin/timmanagement/delete/{id}', 'AdminTimManagementController@delete')->name('timmanagement.delete');

    // Fixed Page Article/News
    Route::get('/admin/article', 'AdminArticleController@index')->name('article');
    Route::get('/admin/article/add', 'AdminArticleController@add')->name('article.add');
    Route::post('/admin/article/store', 'AdminArticleController@store')->name('article.store');
    Route::get('/admin/article/edit/{id}', 'AdminArticleController@edit')->name('article.edit');
    Route::post('/admin/article/update/{id}', 'AdminArticleController@update')->name('article.update');
    Route::get('/admin/article/delete/{id}', 'AdminArticleController@delete')->name('article.delete');

    // Fixed Page Article/News
    Route::get('/admin/kategori', 'AdminKategoriController@index')->name('kategori');
    Route::get('/admin/kategori/add', 'AdminKategoriController@add')->name('kategori.add');
    Route::post('/admin/kategori/store', 'AdminKategoriController@store')->name('kategori.store');
    Route::get('/admin/kategori/edit/{id}', 'AdminKategoriController@edit')->name('kategori.edit');
    Route::post('/admin/kategori/update/{id}', 'AdminKategoriController@update')->name('kategori.update');
    Route::get('/admin/kategori/delete/{id}', 'AdminKategoriController@delete')->name('kategori.delete');


    // Fixed Page Setting Compro
    Route::get('/admin/setting_comp', 'AdminSettingCompController@index')->name('setting_comp');
    Route::post('/admin/setting_comp/update', 'AdminSettingCompController@update')->name('setting_comp.update');

    // Fixed Page Our Core Values Compro
    Route::get('/admin/setting_ocv', 'AdminSettingCompController@ocv')->name('setting_ocv');
    Route::post('/admin/setting_ocv/update', 'AdminSettingCompController@ocvupdate')->name('setting_ocv.update');

     // Fixed Page Chariman Message Compro
    Route::get('/admin/setting_cm', 'AdminSettingCompController@cm')->name('setting_cm');
    Route::post('/admin/setting_cm/update', 'AdminSettingCompController@cmupdate')->name('setting_cm.update');

    // Fixed Page Visi Misi
    Route::get('/admin/vision', 'AdminVisionController@index')->name('vision');
    Route::post('/admin/vision/update', 'AdminVisionController@update')->name('vision.update');

    // Fixed Page Manajemen Tim
    Route::get('/admin/team', 'AdminTeamController@index')->name('team');
    Route::post('/admin/team/update', 'AdminTeamController@update')->name('team.update');


    // Fixed IMAGE
    Route::get('/admin/image', 'AdminImageController@index')->name('image');
    Route::post('/admin/image/update', 'AdminImageController@update')->name('image.update');

    // Fixed Page Class Training
    Route::get('/admin/classtraining', 'AdminClassTrainController@index')->name('classtraining');
    Route::get('/admin/classtraining/add', 'AdminClassTrainController@add')->name('classtraining.add');
    Route::post('/admin/classtraining/store', 'AdminClassTrainController@store')->name('classtraining.store');
    Route::get('/admin/classtraining/edit/{id}', 'AdminClassTrainController@edit')->name('classtraining.edit');
    Route::post('/admin/classtraining/update/{id}', 'AdminClassTrainController@update')->name('classtraining.update');
    Route::get('/admin/classtraining/delete/{id}', 'AdminClassTrainController@delete')->name('classtraining.delete');

    // Fixed IMAGE
    Route::get('/admin/image_top', 'AdminImgTopController@index')->name('image_top');
    Route::post('/admin/image_top/update', 'AdminImgTopController@update')->name('image_top.update');

    // Fixed Page Produk
    Route::get('/admin/team_org', 'AdminTeamOrgController@index')->name('team_org');
    Route::get('/admin/team_org/add', 'AdminTeamOrgController@add')->name('team_org.add');
    Route::post('/admin/team_org/store', 'AdminTeamOrgController@store')->name('team_org.store');
    Route::get('/admin/team_org/edit/{id}', 'AdminTeamOrgController@edit')->name('team_org.edit');
    Route::post('/admin/team_org/update/{id}', 'AdminTeamOrgController@update')->name('team_org.update');
    Route::get('/admin/team_org/delete/{id}', 'AdminTeamOrgController@delete')->name('team_org.delete');

    // Fixed Live Chat
    Route::get('/admin/career', 'AdminCareerController@index')->name('career');
    Route::get('/admin/career/add', 'AdminCareerController@add')->name('career.add');
    Route::post('/admin/career/store', 'AdminCareerController@store')->name('career.store');
    Route::get('/admin/career/edit/{id}', 'AdminCareerController@edit')->name('career.edit');
    Route::post('/admin/career/update/{id}', 'AdminCareerController@update')->name('career.update');
    Route::get('/admin/career/delete/{id}', 'AdminCareerController@delete')->name('career.delete');
    Route::post('/admin/career/data', 'AdminCareerController@data')->name('career.data');
    Route::get('/admin/career/text', 'AdminCareerController@editText')->name('career.text');
    Route::post('/admin/career/text', 'AdminCareerController@editTextPost')->name('career.text.post');

    // FAQ Group
    Route::get('/admin/faq/group', 'AdminFaqGroupController@index')->name('faq.group');
    Route::get('/admin/faq/group/add', 'AdminFaqGroupController@add')->name('faq.group.add');
    Route::post('/admin/faq/group/store', 'AdminFaqGroupController@store')->name('faq.group.store');
    Route::get('/admin/faq/group/edit/{id}', 'AdminFaqGroupController@edit')->name('faq.group.edit');
    Route::post('/admin/faq/group/update/{id}', 'AdminFaqGroupController@update')->name('faq.group.update');
    Route::get('/admin/faq/group/delete/{id}', 'AdminFaqGroupController@delete')->name('faq.group.delete');
    Route::post('/admin/faq/group/data', 'AdminFaqGroupController@data')->name('faq.group.data');

    // FAQ
    Route::get('/admin/faq', 'AdminFaqController@index')->name('faq');
    Route::get('/admin/faq/add', 'AdminFaqController@add')->name('faq.add');
    Route::post('/admin/faq/store', 'AdminFaqController@store')->name('faq.store');
    Route::get('/admin/faq/edit/{id}', 'AdminFaqController@edit')->name('faq.edit');
    Route::post('/admin/faq/update/{id}', 'AdminFaqController@update')->name('faq.update');
    Route::get('/admin/faq/delete/{id}', 'AdminFaqController@delete')->name('faq.delete');

    // Slider
    Route::get('/admin/landing_slider', 'AdminLandingSliderController@index')->name('landing.slider');
    Route::get('/admin/landing_slider/add', 'AdminLandingSliderController@add')->name('landing.slider.add');
    Route::post('/admin/landing_slider/store', 'AdminLandingSliderController@store')->name('landing.slider.store');
    Route::get('/admin/landing_slider/edit/{id}', 'AdminLandingSliderController@edit')->name('landing.slider.edit');
    Route::post('/admin/landing_slider/update/{id}', 'AdminLandingSliderController@update')->name('landing.slider.update');
    Route::get('/admin/landing_slider/delete/{id}', 'AdminLandingSliderController@delete')->name('landing.slider.delete');

    Route::get('/admin/landing_image', 'AdminLandingSliderController@imageIndex')->name('landing.image');
    Route::post('/admin/landing_image', 'AdminLandingSliderController@imagePost')->name('landing.image.post');


    // Follow
    Route::get('/admin/follow', 'AdminFollowController@index')->name('follow');
    Route::get('/admin/follow/add', 'AdminFollowController@add')->name('follow.add');
    Route::post('/admin/follow/store', 'AdminFollowController@store')->name('follow.store');
    Route::get('/admin/follow/edit/{id}', 'AdminFollowController@edit')->name('follow.edit');
    Route::post('/admin/follow/update/{id}', 'AdminFollowController@update')->name('follow.update');
    Route::get('/admin/follow/delete/{id}', 'AdminFollowController@delete')->name('follow.delete');

    // Meet Peoples
    Route::get('/admin/meet_people', 'AdminMeetPeopleController@index')->name('meet.people');
    Route::get('/admin/meet_people/add', 'AdminMeetPeopleController@add')->name('meet.people.add');
    Route::post('/admin/meet_people/store', 'AdminMeetPeopleController@store')->name('meet.people.store');
    Route::get('/admin/meet_people/edit/{id}', 'AdminMeetPeopleController@edit')->name('meet.people.edit');
    Route::post('/admin/meet_people/update/{id}', 'AdminMeetPeopleController@update')->name('meet.people.update');
    Route::get('/admin/meet_people/delete/{id}', 'AdminMeetPeopleController@delete')->name('meet.people.delete');


    // Thought Leaders
    Route::get('/admin/leaders', 'AdminLeadersController@index')->name('leader');
    Route::get('/admin/leaders/add', 'AdminLeadersController@add')->name('leader.add');
    Route::post('/admin/leaders/store', 'AdminLeadersController@store')->name('leader.store');
    Route::get('/admin/leaders/edit/{id}', 'AdminLeadersController@edit')->name('leader.edit');
    Route::post('/admin/leaders/update/{id}', 'AdminLeadersController@update')->name('leader.update');
    Route::get('/admin/leaders/delete/{id}', 'AdminLeadersController@delete')->name('leader.delete');

     // Service
    Route::get('/admin/services', 'AdminServicesController@index')->name('service');
    Route::get('/admin/services/add', 'AdminServicesController@add')->name('service.add');
    Route::post('/admin/services/store', 'AdminServicesController@store')->name('service.store');
    Route::get('/admin/services/edit/{id}', 'AdminServicesController@edit')->name('service.edit');
    Route::post('/admin/services/update/{id}', 'AdminServicesController@update')->name('service.update');
    Route::get('/admin/services/delete/{id}', 'AdminServicesController@delete')->name('service.delete');

    // sub services
    Route::get('/admin/services/sub/{sid}', 'AdminSubServicesController@index')->name('subService');
    Route::get('/admin/services/sub/{sid}/add', 'AdminSubServicesController@add')->name('subService.add');
    Route::post('/admin/services/sub/store/{sid}', 'AdminSubServicesController@store')->name('subService.store');
    Route::get('/admin/services/sub/{sid}/edit/{id}', 'AdminSubServicesController@edit')->name('subService.edit');
    Route::post('/admin/services/sub/{sid}/update/{id}', 'AdminSubServicesController@update')->name('subService.update');
    Route::get('/admin/services/sub/{sid}/delete/{id}', 'AdminSubServicesController@delete')->name('subService.delete');

    // services contact
    Route::get('/admin/services/contact', 'AdminServicesContactController@index')->name('serviceContact');
    Route::get('/admin/services/contact/add', 'AdminServicesContactController@add')->name('serviceContact.add');
    Route::post('/admin/services/contact/store', 'AdminServicesContactController@store')->name('serviceContact.store');
    Route::get('/admin/services/contact/edit/{id}', 'AdminServicesContactController@edit')->name('serviceContact.edit');
    Route::post('/admin/services/contact/update/{id}', 'AdminServicesContactController@update')->name('serviceContact.update');
    Route::get('/admin/services/contact/delete/{id}', 'AdminServicesContactController@delete')->name('serviceContact.delete');

    // services partner
    Route::get('/admin/services/partner', 'AdminServicesPartnerController@index')->name('servicePartner');
    Route::get('/admin/services/partner/add', 'AdminServicesPartnerController@add')->name('servicePartner.add');
    Route::post('/admin/services/partner/store', 'AdminServicesPartnerController@store')->name('servicePartner.store');
    Route::get('/admin/services/partner/edit/{id}', 'AdminServicesPartnerController@edit')->name('servicePartner.edit');
    Route::post('/admin/services/partner/update/{id}', 'AdminServicesPartnerController@update')->name('servicePartner.update');
    Route::get('/admin/services/partner/delete/{id}', 'AdminServicesPartnerController@delete')->name('servicePartner.delete');


    //end new


    // Fixed Page register training
    Route::get('/admin/register', 'AdminRegisterController@index')->name('register');
    Route::get('/admin/register/confirmed', 'AdminRegisterController@confirmed')->name('register.confirmed');
    Route::get('/admin/register/payment/{id}', 'AdminRegisterController@payment')->name('register.payment');
    Route::post('/admin/register/paymentDo/{id}', 'AdminRegisterController@paymentDo')->name('register.paymentDo');

    Route::get('/admin/register/add', 'AdminRegisterController@add')->name('register.add');
    Route::post('/admin/register/store', 'AdminRegisterController@store')->name('register.store');
    Route::get('/admin/register/edit/{id}', 'AdminRegisterController@edit')->name('register.edit');
    Route::get('/admin/register/detail/{id}', 'AdminRegisterController@detail')->name('register.detail');
    Route::get('/admin/register/confirm/{id}', 'AdminRegisterController@confirm')->name('register.confirm');
    Route::post('/admin/register/update/{id}', 'AdminRegisterController@update')->name('register.update');
    Route::get('/admin/register/delete/{id}', 'AdminRegisterController@delete')->name('register.delete');

// -----------------------------------------------------------------------------------------------------------

    //Profile Dealer
    Route::get('/admin/profile/dealer', 'ProfileDealerController@index')->name('profile.dealer');
    Route::get('/admin/profile/dealer/edit', 'ProfileDealerController@edit')->name('profileedit.dealer');
    Route::post('/admin/profile/dealer/update', 'ProfileDealerController@update')->name('profileupdate.dealer');

    //Dealer
    Route::get('/admin/dealers', 'DealerController@index')->name('dealers');
    Route::get('/admin/dealer/add', 'DealerController@add')->name('dealer.add');
    Route::post('/admin/dealer/store', 'DealerController@store')->name('dealer.store');
    Route::get('/admin/dealer/edit/{id}', 'DealerController@edit')->name('dealer.edit');
    Route::post('/admin/dealer/update/{id}', 'DealerController@update')->name('dealer.update');
    Route::get('/admin/dealer/delete/{id}', 'DealerController@delete')->name('dealer.delete');

    //Setting
    Route::get('/admin/setting', 'SettingController@index')->name('setting');
    Route::post('/admin/setting/update', 'SettingController@update')->name('setting.update');

    //Inbox
    Route::get('/admin/inboxs', 'InboxController@index')->name('inbox');
    Route::get('/admin/inbox/delete', 'InboxController@delete')->name('inbox.delete');
    Route::get('/admin/inbox/sentitem', 'InboxController@sentitem')->name('inbox.sentitem');
    Route::get('/admin/inbox/detail/{id}', 'InboxController@detail')->name('inbox.detail');
    Route::post('/admin/inbox/reply/{id}', 'InboxController@reply')->name('inbox.reply');

    //Post Page
    Route::get('/admin/pages', 'PostController@index')->name('pages');
    Route::get('/admin/page/add', 'PostController@add')->name('page.add');
    Route::post('/admin/page/store', 'PostController@store')->name('page.store');
    Route::get('/admin/page/edit/{id}', 'PostController@edit')->name('page.edit');
    Route::post('/admin/page/update/{id}', 'PostController@update')->name('page.update');
    Route::get('/admin/page/delete/{id}', 'PostController@delete')->name('page.delete');

    //User
    Route::get('/admin/users', 'UserController@index')->name('users');
    Route::get('/admin/user/add', 'UserController@add')->name('user.add');
    Route::post('/admin/user/store', 'UserController@store')->name('user.store');
    Route::get('/admin/user/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/admin/user/update/{id}', 'UserController@update')->name('user.update');
    Route::get('/admin/user/delete/{id}', 'UserController@delete')->name('user.delete');

    //Bidding Page
    Route::get('/admin/biddings', 'BiddingController@index')->name('biddings');
    Route::get('/admin/bidding/detail/{id}', 'BiddingController@detail')->name('bidding.detail');
    Route::get('/admin/bidding/sentitem', 'BiddingController@sentitem')->name('bidding.sentitem');
    Route::post('/admin/bidding/reply/{id}', 'BiddingController@reply')->name('bidding.reply');

    //Push Page
    Route::get('/admin/push/home', 'PushController@index')->name('pushs');
    Route::get('/admin/push/pencarian', 'PushController@pencarian')->name('push.pencarian');
    Route::get('/admin/push/add/home', 'PushController@add')->name('push.add');
    Route::get('/admin/push/add/pencarian', 'PushController@addpencarian')->name('push.addpencarian');
    Route::post('/admin/push/store', 'PushController@store')->name('push.store');
    Route::get('/admin/push/edit/home/{id}', 'PushController@edit')->name('push.edit');
    Route::get('/admin/push/edit/pencarian/{id}', 'PushController@editpencarian')->name('push.edit');
    Route::post('/admin/push/update/{id}', 'PushController@update')->name('push.update');
    Route::get('/admin/push/delete/{id}', 'PushController@delete')->name('push.delete');

    //Subscribe
    Route::get('/admin/subscribes', 'SubscribeController@index')->name('subscribes');
    Route::get('/admin/subscribe/add', 'SubscribeController@add')->name('subscribe.add');
    Route::post('/admin/subscribe/store', 'SubscribeController@store')->name('subscribe.store');
    Route::get('/admin/subscribe/edit/{id}', 'SubscribeController@edit')->name('subscribe.edit');
    Route::post('/admin/subscribe/update/{id}', 'SubscribeController@update')->name('subscribe.update');
    Route::get('/admin/subscribe/delete/{id}', 'SubscribeController@delete')->name('subscribe.delete');

    //Merk
    Route::get('/admin/merks', 'MerkController@index')->name('merks');
    Route::get('/admin/merk/add', 'MerkController@add')->name('merk.add');
    Route::post('/admin/merk/store', 'MerkController@store')->name('merk.store');
    Route::get('/admin/merk/edit/{id}', 'MerkController@edit')->name('merk.edit');
    Route::post('/admin/merk/update/{id}', 'MerkController@update')->name('merk.update');
    Route::get('/admin/merk/delete/{id}', 'MerkController@delete')->name('merk.delete');
    Route::get('/admin/mobil/type/{id}', 'MerkController@type')->name('merk.type');
    Route::get('/admin/mobil/type/add/{id}', 'MerkController@addtype')->name('merk.addtype');
    Route::post('/admin/mobil/storetype/{id}', 'MerkController@storetype')->name('merk.storetype');
    Route::get('/admin/mobil/type/edit/{id}', 'MerkController@edittype')->name('merk.edittype');
    Route::post('/admin/mobil/type/update/{id}', 'MerkController@updatetype')->name('merk.updatetype');
    Route::get('/admin/mobil/type/delete/{id}', 'MerkController@deletetype')->name('merk.deletetype');


    /* TEST ONLINE */

    // ADMIN
    Route::get('/admin/career_list', 'TestOnline\TestModuleAssignmentController@career_list')->name('admin.career.list');
    Route::get('/admin/module_list/{id}', 'TestOnline\TestModuleAssignmentController@module_list')->name('admin.module.list');

    // MODULES ASSIGNMENT
    Route::get('/admin/module/assignment', 'TestOnline\TestModuleAssignmentController@index')->name('module.assignment.index');
    Route::get('/admin/module/assignment/add', 'TestOnline\TestModuleAssignmentController@add')->name('module.assignment.add');
    Route::post('/admin/module/assignment/store', 'TestOnline\TestModuleAssignmentController@store')->name('module.assignment.store');
    Route::delete('/admin/module/assignment/delete/{id}', 'TestOnline\TestModuleAssignmentController@delete')->name('module.assignment.delete');
    Route::post('/admin/module/assignment/datatable', 'TestOnline\TestModuleAssignmentController@datatable')->name('module.assignment.datatable');

    // MODULES
    Route::get('/admin/module', 'TestOnline\TestModuleController@index')->name('module.index');
    Route::get('/admin/module/add', 'TestOnline\TestModuleController@add')->name('module.add');
    Route::post('/admin/module/store', 'TestOnline\TestModuleController@store')->name('module.store');
    Route::get('/admin/module/edit/{id}', 'TestOnline\TestModuleController@edit')->name('module.edit');
    Route::post('/admin/module/update/{id}', 'TestOnline\TestModuleController@update')->name('module.update');
    Route::delete('/admin/module/delete/{id}', 'TestOnline\TestModuleController@delete')->name('module.delete');
    Route::post('/admin/module/datatable', 'TestOnline\TestModuleController@datatable')->name('module.datatable');
    Route::post('/admin/module/data', 'TestOnline\TestModuleController@data')->name('module.data');

    // STEP
    Route::get('/admin/step', 'TestOnline\TestStepController@index')->name('step.index');
    Route::get('/admin/step/add', 'TestOnline\TestStepController@add')->name('step.add');
    Route::post('/admin/step/store', 'TestOnline\TestStepController@store')->name('step.store');
    Route::get('/admin/step/edit/{id}', 'TestOnline\TestStepController@edit')->name('step.edit');
    Route::post('/admin/step/update/{id}', 'TestOnline\TestStepController@update')->name('step.update');
    Route::delete('/admin/step/delete/{id}', 'TestOnline\TestStepController@delete')->name('step.delete');
    Route::post('/admin/step/datatable', 'TestOnline\TestStepController@datatable')->name('step.datatable');
    Route::post('/admin/step/data', 'TestOnline\TestStepController@data')->name('step.data');

    // QUESTION
    Route::get('/admin/question', 'TestOnline\TestQuestionController@index')->name('question.index');
    Route::get('/admin/question/add', 'TestOnline\TestQuestionController@add')->name('question.add');
    Route::post('/admin/question/store', 'TestOnline\TestQuestionController@store')->name('question.store');
    Route::get('/admin/question/edit/{id}', 'TestOnline\TestQuestionController@edit')->name('question.edit');
    Route::post('/admin/question/update/{id}', 'TestOnline\TestQuestionController@update')->name('question.update');
    Route::delete('/admin/question/delete/{id}', 'TestOnline\TestQuestionController@delete')->name('question.delete');
    Route::post('/admin/question/datatable', 'TestOnline\TestQuestionController@datatable')->name('question.datatable');
    Route::post('/admin/question/data', 'TestOnline\TestQuestionController@data')->name('question.data');


    // RESULT RECRUITMENT
    Route::get('/admin/result', 'TestOnline\TestResultController@index')->name('result.index');
    Route::post('/admin/result/datatable', 'TestOnline\TestResultController@datatable')->name('result.datatable');
    Route::post('/admin/result/module/datatable', 'TestOnline\TestResultController@moduleDatatable')->name('result.module.datatable');
    Route::get('/admin/result/marking/{id?}', 'TestOnline\TestResultController@marking')->name('result.marking');
    Route::post('/admin/result/marking', 'TestOnline\TestResultController@markingPost')->name('result.marking.post');
    Route::post('/admin/result/export', 'TestOnline\TestResultController@export')->name('result.export');
    Route::post('/admin/result/career/export', 'TestOnline\TestResultController@exportCareer')->name('result.career.export');
    // Route::post('/admin/result/export-pdf', 'TestOnline\TestResultController@exportPdf')->name('result.export.pdf');
    Route::get('/admin/result/export-pdf/{career_id?}/{module_id?}/{user_id?}', 'TestOnline\TestResultController@exportPdf')->name('result.export.pdf');


    // PARTICIPANT
    Route::get('/admin/participant/{mode?}', 'TestOnline\ParticipantController@index')->name('participant.index');
    Route::post('/admin/participant/{mode?}', 'TestOnline\ParticipantController@datatable')->name('participant.datatable');
    Route::get('/admin/participant/{mode?}/{id?}', 'TestOnline\ParticipantController@change')->name('participant.change');


});


Route::get('/logout', function() {
    Session::forget('key');
     if(!Session::has('key'))
      {
         return "signout";
      }
    });

Route::get('/setlang', 'NewComproController@setlang')->name('compro.setlang');

Route::get('/{lang?}', 'NewComproController@index')->name('compro.home');
