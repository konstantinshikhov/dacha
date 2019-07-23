<?php


Route::group([
    'middleware' => 'api',
    'prefix' => 'assortment'],
    function () {
        Route::post('index', 'AssortmentController@index');
        Route::post('indexreserves', 'AssortmentController@indexreserves');
        Route::post('index_groups', 'AssortmentController@index_groups');
        Route::post('edit', 'AssortmentController@edit');
        Route::post('showitemlist', 'AssortmentController@showitemlist');
        Route::post('showitemcategories', 'AssortmentController@showitemcategories');
        Route::post('create', 'AssortmentController@create');
        Route::post('delete', 'AssortmentController@delete');
        Route::post('showcategories', 'AssortmentController@showcategories');
        Route::post('showtariffs', 'AssortmentController@showtariffs');
        Route::post('createmarket', 'AssortmentController@createmarket');
        Route::post('editmarket', 'AssortmentController@editmarket');
        Route::post('deletemarket', 'AssortmentController@deletemarket');
        Route::post('showmarketsbyproduct', 'AssortmentController@showmarketsbyproduct');
        Route::post('export', 'AssortmentController@export');
        Route::post('import', 'AssortmentController@import');
    });
//
//Route::group([
//    'middleware' => 'api',
//    'prefix' => 'auth'
//], function () {
//    // Auth
//    Route::post('login', 'AuthController@login');
////    Route::post('register', 'AuthController@register');
//    Route::post('me', 'AuthController@me');
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
//    Route::post('change-password', 'AuthController@changePassword');
//    Route::post('forgot-password', 'AuthController@forgotPassword');
//    Route::post('reset-password', 'AuthController@resetPassword');
//});

Route::group([
    'middleware' => 'api',
    'prefix' => 'bookmarks'
], function () {
    // Bookmarks
    Route::get('index', 'BookmarksController@index');
    Route::post('changefolder', 'BookmarksController@changefolder');
    Route::post('destroy', 'BookmarksController@destroy');
    Route::post('showfolders', 'BookmarksController@showfolders');
    Route::post('createfolder', 'BookmarksController@createfolder');
    Route::post('editfolder', 'BookmarksController@editfolder');
    Route::post('deletefolder', 'BookmarksController@deletefolder');


});

Route::group([
    'middleware' => 'api',
    'prefix' => 'chemicals'
], function () {
    // chemicals
    Route::post('index', 'ChemicalController@index');
    Route::post('searchautocomplete', 'ChemicalController@searchautocomplete');
    Route::post('show/{id}', 'ChemicalController@show');
    Route::post('answers/{id}', 'ChemicalController@answers');
    Route::post('addresponse', 'ChemicalController@addresponse');
    Route::post('createorder', 'ChemicalController@createorder');
    Route::post('checkisordered', 'ChemicalController@checkisordered');
    Route::post('addtobookmark', 'ChemicalController@addtobookmark');
    Route::post('checkisbookmark', 'ChemicalController@checkisbookmark');
    Route::post('deletefrombookmark', 'ChemicalController@deletefrombookmark');
    Route::post('showchemicalfilter', 'ChemicalController@showchemicalfilter');

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'culture'
], function () {
    Route::post('index', 'CultureController@index');
    Route::post('show/{id}', 'CultureController@show');
    Route::post('showfilter', 'CultureController@showfilter');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'decorator'],
    function () {
        Route::post('index', 'DecoratorController@index');//show decorators
        Route::post('showfilter', 'DecoratorController@showfilter');
        Route::post('show/{id}', 'DecoratorController@show');//show decorator
        Route::post('showproject/{id}', 'DecoratorController@showproject');//show decorator
        Route::post('become', 'DecoratorController@become');//become decorator
        Route::post('isdecorator/{id}', 'DecoratorController@isdecorator');//is decorator
        Route::post('break', 'DecoratorController@break');//break decorator
        Route::post('getuserfilter', 'DecoratorController@getuserfilter');//show user roles
        Route::post('setroles', 'DecoratorController@setroles');
        Route::post('unsetroles', 'DecoratorController@unsetroles');
        Route::post('createproject', 'DecoratorController@createproject');//createproject decorator
        Route::post('deleteproject', 'DecoratorController@deleteproject');
        Route::post('editproject', 'DecoratorController@editproject');//editproject decorator
        Route::post('addphoto', 'DecoratorController@addphoto');//
        Route::post('editphoto', 'DecoratorController@editphoto');//
        Route::post('deletephoto', 'DecoratorController@deletephoto');//
        Route::post('addtobookmark', 'DecoratorController@addtobookmark');
        Route::post('checkisbookmark', 'DecoratorController@checkisbookmark');
        Route::post('deletefrombookmark', 'DecoratorController@deletefrombookmark');
        Route::post('sendmessage', 'DecoratorController@sendmessage');
    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'disease'],
    function () {
        // disease
        Route::post('index', 'DiseaseController@index');
        Route::post('show/{id}', 'DiseaseController@show');
        Route::post('addphoto', 'DiseaseController@add_photo');
        Route::post('addtobookmark', 'DiseaseController@addtobookmark');
        Route::post('checkisbookmark', 'DiseaseController@checkisbookmark');
        Route::post('deletefrombookmark', 'DiseaseController@deletefrombookmark');
        Route::post('showdiseasefilter', 'DiseaseController@showdiseasefilter');
    });


Route::group([
    'middleware' => 'api',
    'prefix' => 'ethnoscience'],
    function () {
        // disease
        Route::post('index', 'EthnoscienceController@index');
    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'event'],
    function () {
        Route::post('index', 'EventController@index');
        Route::post('show', 'EventController@show');
        Route::post('create', 'EventController@create');
        Route::post('edit', 'EventController@edit');
        Route::post('delete', 'EventController@delete');
        Route::post('takepart', 'EventController@takepart');
        Route::post('checkpart', 'EventController@checkpart');
        Route::post('untakepart', 'EventController@untakepart');
        Route::post('showfilter', 'EventController@showfilter');
        Route::post('addtobookmark', 'EventController@addtobookmark');
        Route::post('checkisbookmark', 'EventController@checkisbookmark');
        Route::post('deletefrombookmark', 'EventController@deletefrombookmark');
    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'handbook'],
    function () {
        Route::post('index', 'HandbookController@index');
        Route::post('show/{id}', 'HandbookController@show');
        Route::post('addvideolink', 'HandbookController@addvideolink');
        Route::post('addtobookmark', 'HandbookController@addtobookmark');
        Route::post('checkisbookmark', 'HandbookController@checkisbookmark');
        Route::post('deletefrombookmark', 'HandbookController@deletefrombookmark');
        Route::post('showfilter', 'HandbookController@showfilter');
        Route::post('addarticle', 'HandbookController@addarticle');
    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'mainpage'], function () {
    Route::post('index', 'MainPageController@index');
    Route::post('search', 'MainPageController@search');
    Route::post('searchlocal', 'MainPageController@searchlocal');
    Route::post('feedback', 'MainPageController@feedback');
    Route::post('footer', 'MainPageController@footer');
    Route::post('generalinfo', 'MainPageController@generalinfo');
    Route::post('refreshindex', 'MainPageController@refreshindex');
    Route::post('dbclearing', 'MainPageController@dbclearing');

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'notification'
], function () {
    // User
    Route::post('index', 'NotificationController@index');
    Route::post('markasread', 'NotificationController@markasread');
    Route::post('markasreadall', 'NotificationController@markasreadall');
    Route::post('delete', 'NotificationController@delete');
    Route::post('deleteall', 'NotificationController@deleteall');

});



Route::group([
    'middleware' => 'api',
    'prefix' => 'order'],
    function () {
        Route::post('index', 'OrderController@index');
        Route::post('indexnewitems', 'OrderController@indexnewitems');
        Route::post('showsellers', 'OrderController@showsellers');
        Route::post('chooseseller', 'OrderController@chooseseller');
        Route::post('combine', 'OrderController@combine');
        Route::post('editdelivery', 'OrderController@editdelivery');
        Route::post('edititem', 'OrderController@edititem');
        Route::post('deleteitem', 'OrderController@deleteitem');
        Route::post('agreement', 'OrderController@agreement');
        Route::post('reject', 'OrderController@reject');
        Route::post('accept', 'OrderController@accept');
        Route::post('toreserv', 'OrderController@toreserv');
        Route::post('reserved', 'OrderController@reserved');
        Route::post('confirm_reserved', 'OrderController@confirm_reserved');
        Route::post('sended', 'OrderController@sended');
        Route::post('relised', 'OrderController@relised');
        Route::post('sendmessage', 'OrderController@sendmessage');
    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'pest'],
    function () {
        Route::post('index', 'PestController@index');
        Route::post('show/{id}', 'PestController@show');
        Route::post('addphoto', 'PestController@add_photo');
        Route::post('addtobookmark', 'PestController@addtobookmark');
        Route::post('checkisbookmark', 'PestController@checkisbookmark');
        Route::post('deletefrombookmark', 'PestController@deletefrombookmark');
        Route::post('showpestfilter', 'PestController@showpestfilter');

    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'response'],
    function () {
        Route::post('index', 'ResponseController@index');
        Route::post('answers', 'ResponseController@answers');
        Route::post('addresponse', 'ResponseController@addresponse');
        Route::post('addanswer', 'ResponseController@addanswer');
    });

Route::group([
    'middleware' => 'api',
    'prefix' => 'question'
], function () {
    Route::post('index', 'QuestionController@index');
    Route::post('showfilter', 'QuestionController@showfilter');
    Route::post('show/{id}', 'QuestionController@show');
    Route::post('create', 'QuestionController@create');
    Route::post('edit', 'QuestionController@edit');
    Route::post('delete', 'QuestionController@delete');
    Route::post('createanswer', 'QuestionController@createanswer');
    Route::post('editanswer', 'QuestionController@editanswer');
    Route::post('deleteanswer', 'QuestionController@deleteanswer');
    Route::post('addtobookmark', 'QuestionController@addtobookmark');
    Route::post('checkisbookmark', 'QuestionController@checkisbookmark');
    Route::post('deletefrombookmark', 'QuestionController@deletefrombookmark');
    Route::post('addtolike', 'QuestionController@addtolike');
    Route::post('deletefromlike', 'QuestionController@deletefromlike');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'seller'
], function () {
    Route::post('index', 'SellerController@index');
    Route::post('showfilter', 'SellerController@showfilter');
    Route::post('show', 'SellerController@show');
    Route::post('addtobookmark', 'SellerController@addtobookmark');
    Route::post('checkisbookmark', 'SellerController@checkisbookmark');
    Route::post('deletefrombookmark', 'SellerController@deletefrombookmark');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'section'
], function () {
    Route::get('index', 'SectionController@index');
 });

Route::group([
    'middleware' => 'api',
    'prefix' => 'sort'
], function () {
    Route::post('index', 'SortController@index');
    Route::post('show/{id}', 'SortController@show');
    Route::post('getCalendarChartData/{id}', 'SortController@getCalendarChartData');
    Route::post('addresponse', 'SortController@addresponse');
    Route::post('createorder', 'SortController@createorder');
    Route::post('addtousersort', 'SortController@addtousersort');
    Route::post('checkisusersort', 'SortController@checkisusersort');
    Route::post('deletefromsersort', 'SortController@deletefromsersort');
    Route::post('addtobookmark', 'SortController@addtobookmark');
    Route::post('checkisbookmark', 'SortController@checkisbookmark');
    Route::post('deletefrombookmark', 'SortController@deletefrombookmark');
    Route::post('checkisbookmark', 'SortController@checkisbookmark');
    Route::post('checkisordered', 'SortController@checkisordered');
    Route::post('indexgeneralinfo', 'SortController@indexgeneralinfo');
    Route::post('showgeneralinfo', 'SortController@showgeneralinfo');
    Route::post('creategeneralinfo', 'SortController@creategeneralinfo');
    Route::post('editgeneralinfo', 'SortController@editgeneralinfo');
    Route::post('delgeneralinfo', 'SortController@delgeneralinfo');
    Route::post('indexquestionaries', 'SortController@indexquestionaries');
    Route::post('showquestionaries', 'SortController@showquestionaries');
    Route::post('createquestionaries', 'SortController@createquestionaries');
    Route::post('editquestionaries', 'SortController@editquestionaries');
    Route::post('delquestionaries', 'SortController@delquestionaries');
    Route::post('showfilter', 'SortController@showfilter');
    Route::post('mooncalendar', 'SortController@mooncalendar');
    Route::post('pivottable', 'SortController@pivottable');
    Route::post('activity', 'SortController@activity');


});

Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
], function () {
    // User
    Route::get('index', 'UserController@index');
    Route::post('update', 'UserController@update');
    Route::post('showdeliverymethods', 'UserController@showdeliverymethods');
    Route::post('updatedeliverymethods', 'UserController@updatedeliverymethods');
    Route::post('mysorts', 'UserController@mysorts');
    Route::post('alerts', 'UserController@alerts');
    Route::post('rating', 'UserController@rating');
});