<?php

// ROUTES FROM REG

Route::get('/addTest', 'Auth\LoginController@addTest')->name('addTest');
Route::get('/home', 'HomeController@index')->name('home_reg');
Route::get('/action/{halaman}/{idjob}', 'HomeController@action')->name('home_action');
Route::get('/hometest/{id}', 'HomeController@hometest')->name('hometest');
Route::get('/logoutreg/{id}', 'HomeController@logoutreg')->name('logoutreg');

//aktifasi akun
Route::get('/activation/{email}/{idjob}', 'WebsiteController@aktifiasi')->name('home.aktifiasi');

//send notifikasi
Route::get('/submit/{idjob}', 'HomeController@submitjob')->name('submitjob');

// REGISTER VERIFICATION
Route::get('/register-verify/{email}', 'Auth\RegisterController@verify')->name('register.verify');
Route::post('/register-verifying', 'Auth\RegisterController@verifying')->name('register.verifying');
Route::get('/resend-verify/{email}', 'Auth\RegisterController@resend')->name('register.resend');

//Forgot Password
Route::get('/forgot-password-email', 'WebsiteController@lupapassword')->name('lupapassword');
Route::post('/forgot-password-email', 'WebsiteController@lupapasswordpost')->name('lupapassword.post');

//Personal Information
Route::get('/personal-information/{idjob}', 'PelamarpribadiController@wizard')->name('wizard');
Route::post('/personal-information/post', 'PelamarpribadiController@wizard_post')->name('wizard.post');
Route::get('/personal-information/step/2/{idjob}', 'PelamarpribadiController@wizard_step2')->name('wizard_step2');
Route::post('/personal-information/step2/post', 'PelamarpribadiController@wizard_post_step2')->name('wizard.post.step2');
Route::get('/personal-information/step/3/{idjob}', 'PelamarpribadiController@wizard_step3')->name('wizard_step3');
Route::post('/personal-information/step3/post', 'PelamarpribadiController@wizard_post_step3')->name('wizard.post.step3');
Route::get('/personal-information/summary/{idjob}', 'PelamarpribadiController@wizard_summary')->name('wizard_summary');
Route::get('/personal-information/lock/{idjob}', 'PelamarpribadiController@lock')->name('lock');
Route::get('/personal-information/truncate', 'PelamarpribadiController@truncate')->name('wizard.truncate');

//English
Route::get('/english/{idjob}', 'EnglishController@step1')->name('english.step1');
Route::post('/english/step1/post', 'EnglishController@step1_post')->name('english.step1.post');
Route::get('/english/step/2/{idjob}', 'EnglishController@step2')->name('english.step2');
Route::post('/english/step2/post', 'EnglishController@step2_post')->name('english.step2.post');
Route::get('/english/step/3/{idjob}', 'EnglishController@step3')->name('english.step3');
Route::post('/english/step3/post', 'EnglishController@step3_post')->name('english.step3.post');
Route::get('/english/step/4/{idjob}', 'EnglishController@step4')->name('english.step4');
Route::post('/english/step4/post', 'EnglishController@step4_post')->name('english.step4.post');
Route::get('/english/summary/{idjob}', 'EnglishController@english_summary')->name('english_summary');
Route::get('/english/truncate', 'EnglishController@truncate')->name('english.truncate');

//Health
Route::get('/health/{idjob}', 'HealthController@step1')->name('health.step1');
Route::post('/health/step1/post', 'HealthController@step1_post')->name('health.step1.post');
Route::get('/health/truncate', 'HealthController@truncate')->name('health.truncate');

//Technical
Route::get('/technical/{idjob}', 'TechnicalController@test1')->name('technical.test1');
Route::post('/technical/step1/post', 'TechnicalController@step1_post')->name('technical.step1.post');
Route::get('/technical/step/2/{idjob}', 'TechnicalController@test2')->name('technical.test2');
Route::post('/technical/step2/post', 'TechnicalController@step2_post')->name('technical.step2.post');
Route::get('/technical/truncate', 'TechnicalController@truncate')->name('technical.truncate');

Route::get('/technical/set/3/{idjob}', 'TechnicalController@set3')->name('technical.set3');
Route::post('/technical/set3/post', 'TechnicalController@set3_post')->name('technical.set3.post');
Route::get('/technical/set/4/{idjob}', 'TechnicalController@set4')->name('technical.set4');
Route::post('/technical/set4/post', 'TechnicalController@set4_post')->name('technical.set4.post');

//Tax
Route::get('/tax/step/1/{idjob}', 'TaxController@step1')->name('tax.step1');
Route::post('/tax/step1/post', 'TaxController@step1_post')->name('tax.step1.post');
Route::get('/tax/step/2/{idjob}', 'TaxController@step2')->name('tax.step2');
Route::post('/tax/step2/post', 'TaxController@step2_post')->name('tax.step2.post');
Route::get('/tax/step/3/{idjob}', 'TaxController@step3')->name('tax.step3');
Route::post('/tax/step3/post', 'TaxController@step3_post')->name('tax.step3.post');
Route::post('/update', function () {
    return view('admin/update');
 });
//Personality Test
Route::get('/personality/test/{idjob}', 'PersonalityController@step1')->name('personality_test');
Route::post('/personality/test/post', 'PersonalityController@step1_post')->name('personality_test.post');
Route::get('/personality/truncate', 'PersonalityController@truncate')->name('personality_test.truncate');

Route::group(['prefix' => 'administrator', 'middleware' => 'admin'], function() {

    Route::get('/dashboard', 'Admin\ResultController@dashboard')->name('result.dashboard');
    Route::get('/forms', 'Admin\ResultController@forms')->name('result.forms');
    Route::get('/jobs', 'Admin\ResultController@jobs')->name('result.jobs');
    //User
    Route::get('/users', 'Admin\ResultController@users')->name('result.users');
    Route::get('/user/baru', 'Admin\ResultController@baru')->name('result.baru');
    Route::get('/user/tolak', 'Admin\ResultController@tolak')->name('result.tolak');
    Route::get('/user/interview', 'Admin\ResultController@interview')->name('result.interview');
    Route::get('/user/detail/{id}', 'Admin\ResultController@userresult')->name('result.userresult');
    Route::get('/user/acttolak/{iduser}/{idjob}', 'Admin\ResultController@acttolak')->name('result.acttolak');
    Route::get('/user/actinterview/{iduser}/{idjob}', 'Admin\ResultController@actinterview')->name('result.actinterview');

    //Result
    Route::get('/result/english/{iduser}/{idjob}', 'Admin\Result\EnglishController@step1')->name('result.english.step1');

});

Route::group(['prefix' => 'result', 'middleware' => 'admin'], function() {

    //Result
    //English Essay
    Route::get('/english/{iduser}/{idjob}', 'Admin\Result\EnglishController@summary')->name('result.english.summary');

    //Personal Information
    Route::get('/personal-information/{iduser}/{idjob}', 'Admin\Result\PelamarpribadiController@summary')->name('result.summary');

    //Personality Test
    Route::get('/personality/test/{iduser}/{idjob}', 'Admin\Result\PersonalityController@summary')->name('result.personality_test');

    //Health
    Route::get('/health/{iduser}/{idjob}', 'Admin\Result\HealthController@step1')->name('result.health.step1');

    //Soal Ketelitian
    Route::get('/ketelitian/{iduser}/{idjob}', 'Admin\Result\TaxController@step2')->name('result.tax.step2');

});

// QUESTION
Route::group(['prefix' => 'question', 'middleware' => 'admin'], function() {
    Route::get('/preview/{id}', 'TestOnline\TestQuestionController@preview')->name('question.preview');
});

// STEP
Route::group(['prefix' => 'step', 'middleware' => 'admin'], function() {
    Route::get('/preview/{id}', 'TestOnline\TestStepController@preview')->name('step.preview');
    Route::post('/preview/post', 'TestOnline\TestStepController@previewPost')->name('step.preview.post');
});

// MODULE
Route::group(['prefix' => 'module', 'middleware' => 'admin'], function() {
    Route::get('/preview/{id}', 'TestOnline\TestModuleController@preview')->name('module.preview');
    Route::post('/preview/post', 'TestOnline\TestModuleController@previewPost')->name('module.preview.post');
});

// USER
Route::post('/online/test', 'TestOnline\TestOnlineController@start')->name('online.test.start');
Route::post('/online/progress', 'TestOnline\TestOnlineController@progress')->name('online.test.progress');
Route::post('/online/finished', 'TestOnline\TestOnlineController@finished')->name('online.test.finished');
Route::post('/online/finished/result', 'TestOnline\TestOnlineController@finishedResult')->name('online.test.finished.result');
Route::post('/online/test/expired', 'TestOnline\TestOnlineController@expired')->name('online.test.expired');

Route::post('/online/file-upload', 'TestOnline\TestOnlineController@upload')->name('online.upload');
Route::post('/online/file-upload-delete', 'TestOnline\TestOnlineController@uploadDelete')->name('online.upload.delete');
