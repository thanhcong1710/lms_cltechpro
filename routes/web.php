<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Auth'], function () {
    // Web Auth Routes
    Route::get('/login', 'LoginController@showLoginForm');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');

    Route::get('/register', 'RegisterController@showRegistrationForm');
    Route::post('/registerUser', 'RegisterController@register');
});

Route::group(['middleware' => 'notification'], function () {
    Route::get('/', 'WebController@home');

    Route::get('category/{id}', 'WebController@category');
    Route::get('category', 'WebController@category');

    Route::get('search', 'WebController@search');
    Route::get('jsonsearch', 'WebController@jsonSearch');

    ## Blog Section ##
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', 'WebController@blog');
        Route::get('post/{id}', 'WebController@blogPost');
        Route::get('mobile/{id}', 'WebController@blogPostMobile');
        Route::get('category/{id}', 'WebController@blogCategory');
        Route::post('post/comment/store', 'WebController@blogPostCommentStore');
        Route::get('tag/{key}', 'WebController@blogTags');
    });

    ## Gift & Off
    Route::get('gift/{code}', 'WebController@giftChecker');

    ## Chanel Section
    Route::group(['prefix' => 'chanel'], function () {
        Route::get('{username}', 'WebController@chanel');
        Route::get('follow/{id}', 'WebController@chanelFollow');
        Route::get('unfollow/{id}', 'WebController@chanelUnFollow');
    });

    ## Page Section ##
    Route::group(['prefix' => 'page'], function () {
        Route::get('{key}', 'WebController@page');
    });

    ### Product Section ###
    Route::group(['prefix' => 'product'], function () {
        Route::get('{id}', 'WebController@product');
        Route::get('part/{id}/{pid}', 'WebController@productPart');
        ## Comment & Support
        Route::post('comment/store/{id}', 'WebController@productCommentStore');
        Route::post('support/store', 'WebController@productSupportStore');
        Route::get('support/rate/{id}/{rate}', 'WebController@productSupportRate');
        ## Favorite ##
        Route::get('fav/{id}', 'WebController@productFavorite');
        Route::get('unfav/{id}', 'WebController@productUnFavorite');
        Route::get('{id}/rate/{rate}', 'WebController@productRate');
        ## Subscribe ##
        Route::get('subscribe/{id}/{type}/{payMode}', 'WebController@productSubscribe');
    });

    ## Article Section
    Route::group(['prefix' => 'article'], function () {
        Route::get('/list', 'WebController@articles');
        Route::get('item/{id}', 'WebController@articleShow');
    });

    ## Request Section
    Route::group(['prefix' => 'request'], function () {
        Route::get('', 'WebController@requests');
        Route::get('new', 'WebController@newRequest');
        Route::post('store', 'WebController@storeRequest');
        Route::get('follow/{id}', 'WebController@followRequest');
        Route::get('unfollow/{id}', 'WebController@unFollowRequest');
        Route::get('suggestion/{id}/{suggest}', 'WebController@suggestionRequest');
    });

    ### Record Section ###
    Route::group(['prefix' => 'record'], function () {
        Route::get('', 'WebController@records');
        Route::get('follow/{id}', 'WebController@recordFollow');
        Route::get('unfollow/{id}', 'WebController@recordUnFollow');
    });

    ## Video Section ##
    Route::group(['prefix' => 'video'], function () {
        Route::get('stream/{id}', 'WebController@videoStream');
        Route::get('download/{id}', 'WebController@videoDownload');
    });
    Route::get('/progress', 'WebController@videoProgress');

    Route::get('login/{user}', 'WebController@loginTrack');

    ## Usage
    Route::get('usage/{product}/{user}', 'WebController@usageTrack');

    Route::any('payment/wallet/status', 'WebController@walletStatus');


    ### Bank Section ###
    Route::group(['prefix' => 'bank'], function () {

        Route::group(['prefix' => 'paypal'], function () {
            Route::any('status', 'WebController@paypalStatus');
            Route::any('cancel/{id}', 'WebController@paypalCancel');
        });

        Route::group(['prefix' => 'paytm'], function () {
            Route::any('status/{product_id}', 'WebController@paytmStatus');
            Route::any('cancel/{id}', 'WebController@paytmCancel');
        });

        Route::group(['prefix' => 'payu'], function () {
            Route::any('status/{product_id}', 'WebController@payuStatus');
            Route::any('cancel/{id}', 'WebController@payuCancel');
        });

        Route::group(['prefix' => 'paystack'], function () {
            Route::any('status/{id}', 'WebController@paystackStatus');
            Route::any('cancel/{id}', 'WebController@paystackCancel');
        });

        Route::group(['prefix' => 'razorpay'], function () {
            Route::any('status/{id}', 'WebController@razorpayStatus');
        });
    });

});

Route::get('update',function(){
   $users = \App\User::all();
   foreach ($users as $user){
       try {
           $password = decrypt($user->password);
           \App\User::find($user->id)->update(['password'=>\Illuminate\Support\Facades\Hash::make($password)]);
       } catch(\RuntimeException $e) {
       }
   }
});

Route::get('test', function (){
   echo '<form action="https://www.wecashup.cloud/cdn/tests/websites/PHP/callback_lucas.php" method="POST" id="wecashup">
        <script async src="https://www.wecashup.com/library/MobileMoney.js" class="wecashup_button"
          data-demo
          data-sender-lang="en"
          data-sender-phonenumber="+237671234567"
          data-receiver-uid="EvIvZFlBKNaMddjXJOOpEWNeWj52"
          data-receiver-public-key="kCAc2vOwcANrbdKCuFnXLhS76yMx3f8iUytCbN8Drx6T"
          data-transaction-parent-uid=""
          data-transaction-receiver-total-amount="594426"
          data-transaction-receiver-reference="XVT2VBF"
          data-transaction-sender-reference="XVT2VBF"
          data-sender-firstname="Test"
          data-sender-lastname="Test"
          data-transaction-method="pull"
          data-image="https://storage.googleapis.com/wecashup/frontend/img/airfrance.png"
          data-name="Air France"
          data-crypto="true"
          data-cash="true"
          data-telecom="true"
          data-m-wallet="true"
          data-split="true"
          configuration-id="3"
          data-marketplace-mode="false"
          data-product-1-name="Billet ABJ PRS"
          data-product-1-quantity="1"
          data-product-1-unit-price="594426"
          data-product-1-reference="XVT2VBF"
          data-product-1-category="Billeterie"
          data-product-1-description="France is in the Air"

        >
        </script>
    </form>
';
});
