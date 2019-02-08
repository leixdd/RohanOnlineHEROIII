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

Route::get('/', "welcome@index")->name('welcome');

Route::get('/server', function(){
    return view('modules.server');
});

Route::get('/downloads', function(){
    return view('modules.downloads');
});

Route::get('/donate', function(){
    return view('modules.donate');
});

Route::get('/welcome', "welcome@index")->name('welcome');

Route::post('/registration', "USM\Registration@registerUser");
Route::get('/registration', "USM\Registration@viewRegister")->name('registration');
Route::get('/ranking', 'Modules\Ranking@getRanking');

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'User'], function () {
    Route::post('login', 'USM\LoginController@doLogin');
    Route::post('logout', 'USM\LoginController@doLogout');
    Route::get('login', 'USM\LoginController@showLogin')->name('login');
    Route::get('profile', 'USM\ProfileController@showProfile')->name('profile');
    Route::post('ChangePassword', 'USM\ProfileController@ChangePassword');
    Route::post('fix5101', 'USM\ProfileController@fix5101');
    
    //Check Confirmation Code 
    Route::get('confirmation', 'USM\confirmationController@checkCode');
    Route::post('confirmation', 'USM\confirmationController@confirmCode');


    //Murderer Status
    Route::post('rmms', 'USM\ProfileController@removeMS');

    //RKI
    Route::post('rki', 'USM\ProfileController@RKI');

    //UnSeal
    Route::post('unsealed', 'USM\ProfileController@unsealedChar');

    //Selling
    Route::get('sellingInformation/{id}', 'USM\ProfileController@renderSelling');
    Route::post('sellCharacter', 'USM\ProfileController@doSelling');

    //remove from exm
    Route::post('removeFromExm', 'USM\ProfileController@removeFromExm');

    //Quest routes
    //Route::group(['prefix' => 'quests'], function(){
    //    Route::post('acce', 'Modules\QuestRings@submitQuestAcce');
   // });

    //Referral
    Route::group(['prefix' => 'referral'], function(){
        Route::post('generateLink', 'Modules\referralController@generateReferralLink');
    });

});

Route::group(['prefix' => "nqzvacnaryuneevwnaf"], function(){
    
    Route::get('vgrzznantr', "Admin\ItemManage@renderIM");
    Route::post('vgrzznantr', "Admin\ItemManage@saveIM");;
    Route::get('vgrzznantr/AddItem', "Admin\ItemManage@renderAddItem");
    Route::post('vgrzznantr/searchItem', "Admin\ItemManage@searchItem");
    
    Route::get('vgrzznantr/EditItem/{id}', "Admin\ItemManage@editItem");
    Route::post('vgrzznantr/update', "Admin\ItemManage@updateIM");
    //manage post
    Route::post('cms', "Admin\ManagePost@savePost");
});

Route::group(['prefix' => 'news'], function(){
    Route::get('{id}', 'Modules\cmsController@viewNews');
});


Route::group(['prefix' => 'ItemMall'], function() {
    //Route::get('/', 'Modules\ItemMallController@showItemMall');
    //Route::get('/{i}', 'Modules\ItemMallController@showItem');
    //Route::post('/buyItem', 'Modules\ItemMallController@purchaseItem');
});


//Exchange Mall
Route::group(['prefix' => 'ExchangeMall'], function(){
    //Route::get('/', 'Modules\ExchangeMallController@showExchangeMall');
    //Route::post('buyChar', 'Modules\ExchangeMallController@buyChar');
});


Route::group(['prefix' => 'Rewards'], function() {
   // Route::get('/', 'Rewards\rewardsys@index');
    //Route::post('/getReward', 'Rewards\rewardsys@getReward');
});