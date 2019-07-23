<?php


/*
use App\Article;
Route::get('/', function () {
    Article::createIndex($shards = null, $replicas = null);
    Article::putMapping($ignoreConflicts = true);
    Article::addAllToIndex();
    return view('welcome');
});

Route::get('/search', function() {

    $articles = Article::searchByQuery(['match' => ['title' => 'Sed']]);
    return $articles;
});
*/
Route::post('/quest', function () {
   echo "response";
});
Route::post('/cultures/ajax-cultures',function(){
   return 'okey';
});

Route::post('/ajax-questionnair-update','FrontController@updateQuest');
Route::post('/ajax-questionnaire','FrontController@quest');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function()
{
    Route::post('notifications', 'AdminLTEController@createNotifications');
    Route::post('chemicals', 'AdminLTEController@createChemical');
    Route::post('cultures/klumba', 'AdminLTEController@createCultureKlumba');
    Route::post('cultures/ogorod', 'AdminLTEController@createCultureOgorod');
    Route::post('cultures/sad', 'AdminLTEController@createCultureSad');
    Route::post('sorts/klumba', 'AdminLTEController@createSortKlumba');
    Route::post('sorts/ogorod', 'AdminLTEController@createSortOgorod');
    Route::post('sorts/sad', 'AdminLTEController@createSortSad');
    Route::post('filters/klumba', 'AdminLTEController@createFilterKlumba');
    Route::post('filters/ogorod', 'AdminLTEController@createFilterOgorod');
    Route::post('filters/sad', 'AdminLTEController@createFilterSad');
    Route::post('filters/pests', 'AdminLTEController@createFilterPests');
    Route::post('filters/diseases', 'AdminLTEController@createFilterDiseases');
    Route::post('filters/chemicals', 'AdminLTEController@createFilterChemicals');
    Route::post('filters/handbooks', 'AdminLTEController@createFilterHandbooks');
    Route::post('filters/sellers', 'AdminLTEController@createFilterSellers');
    Route::post('filters/decorators', 'AdminLTEController@createFilterDecorators');
    Route::post('filters/attributes', 'AdminLTEController@createFilterAttributes');
    Route::post('filters/events', 'AdminLTEController@createFilterEvents');
    Route::post('diseases/klumba', 'AdminLTEController@createDiseasesKlumba');
    Route::post('diseases/ogorod', 'AdminLTEController@createDiseasesOgorod');
    Route::post('diseases/sad', 'AdminLTEController@createDiseasesSad');
    Route::post('pests/klumba', 'AdminLTEController@createPestsKlumba');
    Route::post('pests/ogorod', 'AdminLTEController@createPestsOgorod');
    Route::post('pests/sad', 'AdminLTEController@createPestsSad');
    Route::post('categories', 'AdminLTEController@createCategories');
    Route::post('characteristics', 'AdminLTEController@createCharacteristics');
    Route::post('handbooks', 'AdminLTEController@createHandbooks');
    Route::post('events', 'AdminLTEController@createEvents');
    Route::post('moderate/photos', 'AdminLTEController@createModeratePhotos');
    Route::post('moderate/responses', 'AdminLTEController@createModerateResponses');
    Route::post('moderate/questions', 'AdminLTEController@createModerateQuestions');
    Route::post('ethnosciences', 'AdminLTEController@createEthnosciences');
    Route::post('moon_phases/dates', 'AdminLTEController@createMoonDates');
    Route::post('moon_phases/phases', 'AdminLTEController@createMoonPhases');
    Route::post('delivery_methods', 'AdminLTEController@createDeliveryMethods');

    Route::get('', 'AdminLTEController@show');
    Route::get('login', 'AdminLTEController@login')->name('adminLogin');
    Route::get('logout', 'AdminLTEController@logout');
    Route::get('feedback', 'AdminLTEController@showFeedback');
    Route::get('notifications', 'AdminLTEController@showNotifications');
    Route::get('users', 'AdminLTEController@showUsers');
    Route::get('questionaries', 'AdminLTEController@showQuestionaries');
    Route::get('questionary', 'AdminLTEController@getQuestionaryFile');
    Route::get('tariffs', 'AdminLTEController@showTariffs');
    Route::get('chemicals', 'AdminLTEController@showChemicals');
    Route::get('cultures/klumba', 'AdminLTEController@showCulturesKlumba');
    Route::get('cultures/ogorod', 'AdminLTEController@showCulturesOgorod');
    Route::get('cultures/sad', 'AdminLTEController@showCulturesSad');
    Route::get('sorts/klumba', 'AdminLTEController@showSortsKlumba');
    Route::get('sorts/ogorod', 'AdminLTEController@showSortsOgorod');
    Route::get('sorts/sad', 'AdminLTEController@showSortsSad');
    Route::get('filters/klumba', 'AdminLTEController@showFiltersKlumba');
    Route::get('filters/ogorod', 'AdminLTEController@showFiltersOgorod');
    Route::get('filters/sad', 'AdminLTEController@showFiltersSad');
    Route::get('filters/pests', 'AdminLTEController@showFiltersPests');
    Route::get('filters/diseases', 'AdminLTEController@showFiltersDiseases');
    Route::get('filters/chemicals', 'AdminLTEController@showFiltersChemicals');
    Route::get('filters/handbooks', 'AdminLTEController@showFiltersHandbooks');
    Route::get('filters/sellers', 'AdminLTEController@showFiltersSellers');
    Route::get('filters/decorators', 'AdminLTEController@showFiltersDecorators');
    Route::get('filters/events', 'AdminLTEController@showFiltersEvents');
    Route::get('diseases/klumba', 'AdminLTEController@showDiseasesKlumba');
    Route::get('diseases/ogorod', 'AdminLTEController@showDiseasesOgorod');
    Route::get('diseases/sad', 'AdminLTEController@showDiseasesSad');
    Route::get('pests/klumba', 'AdminLTEController@showPestsKlumba');
    Route::get('pests/ogorod', 'AdminLTEController@showPestsOgorod');
    Route::get('pests/sad', 'AdminLTEController@showPestsSad');
    Route::get('categories', 'AdminLTEController@showCategories');
    Route::get('characteristics', 'AdminLTEController@showCharacteristics');
    Route::get('handbooks', 'AdminLTEController@showHandbooks');
    Route::get('events', 'AdminLTEController@showEvents');
    Route::get('moderate/photos', 'AdminLTEController@showModeratePhotos');
    Route::get('moderate/videos', 'AdminLTEController@showModerateVideos');
    Route::get('moderate/cultures/Sad', 'AdminLTEController@showModerateResponses');
    Route::get('moderate/questions', 'AdminLTEController@showModerateQuestions');
    Route::get('front_text', 'AdminLTEController@showFrontText');
    Route::get('ethnosciences', 'AdminLTEController@showEthnosciences');
    Route::get('moon_phases/dates', 'AdminLTEController@showMoonDates');
    Route::get('moon_phases/phases', 'AdminLTEController@showMoonPhases');
    Route::get('moon_phases/actions', 'AdminLTEController@showMoonActions');
    Route::get('moon_phases/klumba', 'AdminLTEController@showMoonPhasesKlumba');
    Route::get('moon_phases/ogorod', 'AdminLTEController@showMoonPhasesOgorod');
    Route::get('moon_phases/sad', 'AdminLTEController@showMoonPhasesSad');
    Route::get('delivery_methods', 'AdminLTEController@showDeliveryMethods');
    Route::get('statistics/users', 'AdminLTEController@showStatisticsUsers');
    Route::get('statistics/chemicals', 'AdminLTEController@showStatisticsChemicals');
    Route::get('statistics/cultures', 'AdminLTEController@showStatisticsCultures');
    Route::get('statistics/sorts', 'AdminLTEController@showStatisticsSorts');
    Route::get('statistics/pests_diseases', 'AdminLTEController@showStatisticsPestsDiseases');
    Route::get('statistics/handbooks', 'AdminLTEController@showStatisticsHandbooks');
    Route::get('statistics/events', 'AdminLTEController@showStatisticsEvents');
    Route::get('statistics/photos', 'AdminLTEController@showStatisticsPhotos');
    Route::get('statistics/responses', 'AdminLTEController@showStatisticsResponses');
    Route::get('statistics/questions', 'AdminLTEController@showStatisticsQuestions');
    Route::get('statistics/orders', 'AdminLTEController@showStatisticsOrders');
    Route::get('statistics/questionaries', 'AdminLTEController@showStatisticsQuestionaries');
    Route::get('statistics/questionaries_ajax', 'AdminLTEController@getStatisticsQuestionariesAjax');

    Route::put('feedback', 'AdminLTEController@updateFeedback');
    Route::put('users', 'AdminLTEController@updateUsers');
    Route::put('questionaries', 'AdminLTEController@updateQuestionaries');
    Route::put('tariffs', 'AdminLTEController@updateTariffs');
    Route::put('chemicals', 'AdminLTEController@updateChemicals');
    Route::put('cultures/klumba', 'AdminLTEController@updateCulturesKlumba');
    Route::put('cultures/ogorod', 'AdminLTEController@updateCulturesOgorod');
    Route::put('cultures/sad', 'AdminLTEController@updateCulturesSad');
    Route::put('sorts/klumba', 'AdminLTEController@updateSortsKlumba');
    Route::put('sorts/ogorod', 'AdminLTEController@updateSortsOgorod');
    Route::put('sorts/sad', 'AdminLTEController@updateSortsSad');
    Route::put('filters/klumba', 'AdminLTEController@updateFiltersKlumba');
    Route::put('filters/ogorod', 'AdminLTEController@updateFiltersOgorod');
    Route::put('filters/sad', 'AdminLTEController@updateFiltersSad');
    Route::put('filters/pests', 'AdminLTEController@updateFiltersPests');
    Route::put('filters/diseases', 'AdminLTEController@updateFiltersDiseases');
    Route::put('filters/chemical', 'AdminLTEController@updateFiltersChemicals');
    Route::put('filters/handbooks', 'AdminLTEController@updateFiltersHandbooks');
    Route::put('filters/sellers', 'AdminLTEController@updateFiltersSellers');
    Route::put('filters/decorators', 'AdminLTEController@updateFiltersDecorators');
    Route::put('filters/events', 'AdminLTEController@updateFiltersEvents');
    Route::put('diseases/klumba', 'AdminLTEController@updateDiseasesKlumba');
    Route::put('diseases/ogorod', 'AdminLTEController@updateDiseasesOgorod');
    Route::put('diseases/sad', 'AdminLTEController@updateDiseasesSad');
    Route::put('pests/klumba', 'AdminLTEController@updatePestsKlumba');
    Route::put('pests/ogorod', 'AdminLTEController@updatePestsOgorod');
    Route::put('pests/sad', 'AdminLTEController@updatePestsSad');
    Route::put('categories', 'AdminLTEController@updateCategories');
    Route::put('characteristics', 'AdminLTEController@updateCharacteristics');
    Route::put('handbooks', 'AdminLTEController@updateHandbooks');
    Route::put('events', 'AdminLTEController@updateEvents');
    Route::put('moderate/photos', 'AdminLTEController@updateModeratePhotos');
    Route::put('moderate/videos', 'AdminLTEController@updateModerateVideos');
    Route::put('moderate/responses', 'AdminLTEController@updateModerateResponses');
    Route::put('moderate/questions', 'AdminLTEController@updateModerateQuestions');
    Route::put('front_text', 'AdminLTEController@updateFrontText');
    Route::put('ethnosciences', 'AdminLTEController@updateEthnosciences');
    Route::put('moon_phases/dates', 'AdminLTEController@updateMoonDates');
    Route::put('moon_phases/phases', 'AdminLTEController@updateMoonPhases');
    Route::put('moon_phases/actions', 'AdminLTEController@updateMoonActions');
    Route::put('moon_phases/klumba', 'AdminLTEController@updateMoonPhasesKlumba');
    Route::put('moon_phases/ogorod', 'AdminLTEController@updateMoonPhasesOgorod');
    Route::put('moon_phases/sad', 'AdminLTEController@updateMoonPhasesSad');
    Route::put('delivery_methods', 'AdminLTEController@updateDeliveryMethods');

    Route::delete('chemicals', 'AdminLTEController@deleteChemical');
    Route::delete('cultures/klumba', 'AdminLTEController@deleteCultureKlumba');
    Route::delete('cultures/ogorod', 'AdminLTEController@deleteCultureOgorod');
    Route::delete('cultures/sad', 'AdminLTEController@deleteCultureSad');
    Route::delete('sorts/klumba', 'AdminLTEController@deleteSortKlumba');
    Route::delete('sorts/ogorod', 'AdminLTEController@deleteSortOgorod');
    Route::delete('sorts/sad', 'AdminLTEController@deleteSortSad');
    Route::delete('diseases/klumba', 'AdminLTEController@deleteDiseasesKlumba');
    Route::delete('diseases/ogorod', 'AdminLTEController@deleteDiseasesOgorod');
    Route::delete('diseases/sad', 'AdminLTEController@deleteDiseasesSad');
    Route::delete('pests/klumba', 'AdminLTEController@deletePestsKlumba');
    Route::delete('pests/ogorod', 'AdminLTEController@deletePestsOgorod');
    Route::delete('pests/sad', 'AdminLTEController@deletePestsSad');
    Route::delete('filters', 'AdminLTEController@deleteFilter');
    Route::delete('handbooks', 'AdminLTEController@deleteHandbooks');
    Route::delete('events', 'AdminLTEController@deleteEvents');

});


/**
 * front home
 */


    Route::get('/', 'FrontController@index');
    Route::get('/about-us', 'FrontController@aboutUs');
    Route::get('/learn', 'FrontController@learn');
    Route::get('/events', 'FrontController@events');
    Route::get('/events/view/{id}', 'FrontController@eventsView');
    Route::get('/decorator-all', 'FrontController@decoratorAll');
    Route::get('/decorator-all/view/{id}', 'FrontController@decoratorView');
    Route::get('/news', 'FrontController@news');
    Route::get('/news/view/{id}', 'FrontController@eventsView');
    Route::get('/register', 'FrontController@register');
    Route::post('/registerup', 'FrontController@registerUp');
    Route::get('/log-in', 'FrontController@login');
    Route::get('/logout', 'FrontController@logout');
    Route::post('/log-in', 'FrontController@login');
    Route::get('/culture-all/{culture}', 'FrontController@cultureAll');
    Route::get('/search-cultures', 'FrontController@searchCultures');
    Route::get('/cultures/{culture}/view/{id}', 'FrontController@cultureView');
    Route::get('/cultures/Ogorod', 'FrontController@showCulturesOgorod');
    Route::get('/cultures/Sad', 'FrontController@showCulturesSad');
    Route::get('/cultures/Klumba', 'FrontController@showCulturesKlumba');
    Route::get('/culture-all/{culture}/view/{id}', 'FrontController@cultureView');
    Route::get('/culture-all/view/sellers/{id}', 'FrontController@cultureCurrent');
    Route::get('/sellers', 'FrontController@sellers');
    Route::get('/sellers/{product_id}', 'FrontController@sellers');
    Route::get('/sellers/view/{id}', 'FrontController@suppliers');
    Route::get('/rate', 'FrontController@rate');
    Route::get('/agreement', 'FrontController@agreement');
    Route::get('/pests/{type}', 'FrontController@pests');
    Route::get('/pests/{type}/view/{id}', 'FrontController@pestsView');
    Route::get('/diseases/{type}', 'FrontController@diseases');
    Route::get('/diseases/{type}/view/{id}', 'FrontController@diseasesView');
    Route::get('/reference-information/{type}', 'FrontController@reference');
    Route::get('/reference-information/{type}/view/{id}', 'FrontController@referenceView');
    Route::get('/question/{type}', 'FrontController@question');
    Route::get('/question/view/{id}', 'FrontController@questionView');
    Route::get('/personal-info', 'FrontController@personalInfo');
    Route::post('/personal-info', 'FrontController@personalInfo');
    Route::get('/personal-info/seller', 'FrontController@personalInfoSeller');
    Route::post('/personal-info/seller', 'FrontController@personalInfoSeller');
    Route::get('/personal-info/organizer', 'FrontController@personalInfoOrganizer');
    Route::post('/personal-info/organizer', 'FrontController@personalInfoOrganizer');
    Route::get('/personal-info/decorator', 'FrontController@personalInfoDecorator');
    Route::post('/personal-info/decorator', 'FrontController@personalInfoDecorator');
    Route::get('/my-order', 'FrontController@myOrder');
    Route::get('/assortment', 'FrontController@assortment');
    Route::get('/sumtable', 'FrontController@sumtable');
    Route::get('/my-plants', 'FrontController@myPlants');
    Route::get('/bookmarks', 'FrontController@bookmarks');
    Route::get('/notification', 'FrontController@notification');
    Route::get('/questionnaire', 'FrontController@questionnaire');
    Route::get('/chemical', 'FrontController@chemical');
    Route::get('/chemical/view/{id}', 'FrontController@chemicalView');
    Route::post('/feedback', 'FrontController@mailFeedback');
    Route::get('/user-role/{id}', 'FrontController@userRole');
    Route::post('/modal/addQuestion/', 'FrontController@modalAddQuestion');
    Route::post('/modal/addProduct', 'FrontController@modalAddProduct');
    Route::post('/modal/addAnswer/', 'FrontController@modalAddAnswer');
    Route::post('/modal/UpProduct/', 'FrontController@modalUpProduct');
    Route::post('/addBasketProduct/', 'FrontController@addBasketProduct');
    Route::post('/createOrder', 'FrontController@createOrder');
    Route::post('/add-plants', 'FrontController@addPlants');
    Route::get('/add-plants', 'FrontController@addPlants');

    Route::post('/getParams', 'FrontController@modalGetAddProductParams');
    Route::post('/getDataForModalUpProductFromDB','FrontController@modalGetChangeProductParams');

    Route::post('/culture-all/view/sellers/addComment', 'FrontController@modalAddComment');
    Route::post('/cultures/filterCatalogSad','FrontController@filterCatalogCulturesSad');
    Route::post('pests/filterCatalogPest','FrontController@filterCatalogPest');
    Route::post('diseases/filterCatalogDisease','FrontController@filterCatalogDiseases');
    Route::post('ajax-getname-culture-or-chemicals','FrontController@searchNameForNewProduct');
//    Route::resource('/quest','FrontController@updatequestionaire');
//    Route::post('/culture-all/view/sellers/addComment',function(){
//    return 'modal/addComment';
//    });

//Route::post('ajax-getname-culture-or-chemicals', function () {
//    return "Привет, мир!";
//});

