<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    
    $client = DB::select("select * from ad_client where c_currency_id='304'"); 
    $data['clients'] = $client;
    return view('home',$data);
});*/

Route::get('/', 'HomeController@index');
$router->controllers([
    
    'home' => 'HomeController',
    'trialbalance' => 'TrialbalanceController',
    'purchasedue' => 'PurchaseDueController',
    'purchasedue' => 'PurchaseDueController',
    'salesdue' => 'SalesDueController',
    'paymentduechart' => 'PaymentDueChartController',
    'goodsmovement' => 'GoodsmovementController',
    ]);
//$router->post('trialbalance/acctdata', 'TrialbalanceController@postAcctdata');

Route::resource('home', 'HomeController');
Route::resource('trialbalance', 'TrialbalanceController');
Route::resource('purchasedue', 'PurchaseDueController');
Route::resource('salesdue', 'SalesDueController');
Route::resource('paymentfollowup', 'PaymentfollowupController');
Route::resource('paymentduechart', 'PaymentDueChartController');
Route::resource('goodsmovement', 'GoodsmovementController');

//Route::resource('trialbalance', 'TrialbalanceController@index');
//$router->post('home/acctdata', 'HomeController@getAcctdata');