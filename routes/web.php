<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', 'Main\IndexController@index');

Route::group(['prefix' => 'main', 'namespace' => 'Main', 'as' => 'main.'], function (){
    Route::get('/', ['as' => 'launcher', 'uses' => 'IndexController@launcher']);
    Route::get('/cart', ['as' => 'cart', 'uses' => 'IndexController@showCart']);
    Route::post('/get-carts', ['as' => 'cart.getCarts', 'uses' => 'IndexController@getCarts']);
    Route::post('/coupon-value', ['as' => 'couponValue', 'uses' => 'IndexController@couponValue']);
});


use App\Models\Coupon;
Route::get('/coupons', function () {
    $coupons = Coupon::all();
    echo "<table>";
    echo "<tr>";
    echo "<th>coupon code</th>";
    echo "<th>coupon discount percentage</th>";
    echo "</tr>";
    foreach ($coupons as $coupon){
        echo "<tr>
        <td>$coupon->code</td>
        <td>$coupon->discount</td>

</tr>";
    }
    echo "</table>";
});
