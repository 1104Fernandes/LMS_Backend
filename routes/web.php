<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
/*
 * Category Routes
 */
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/category', 'CategoryController@get');
    $router->post('/category', 'CategoryController@create');
    $router->get('/category/{id}', 'CategoryController@show');
    $router->put('/category/{id}', 'CategoryController@update');
    $router->delete('/category/{id}', 'CategoryController@delete');
    $router->get('/category/getQuestions/{id}', 'CategoryController@getQuestions');
 //
});
/*
 * Question Routes
 */
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/question/', 'QuestionController@get');
    $router->post('/question/', 'QuestionController@create');
    $router->get('/question/{id}', 'QuestionController@getOne');
    $router->put('/question/{id}', 'QuestionController@update');
    $router->delete('/question/{id}', 'QuestionController@delete');
    $router->get('/question/getCategory/{id}', 'QuestionController@getCategory');
    $router->get('/question/getQuiz/{id}', 'QuestionController@getQuiz');
    //$router->get('/question/getAnswers/', 'QuestionController@getAnswers');
    $router->get('/question/getAnswer/{id}', 'QuestionController@getAnswer');
});
/*
 * Answer Routes
 */
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/answer/', 'AnswerController@index');
    $router->post('/answer/', 'AnswerController@create');
    $router->get('/answer/{id}', 'AnswerController@getOne');
    $router->put('/answer/{id}', 'AnswerController@update');
    $router->delete('/answer/{id}', 'AnswerController@delete');
    $router->get('/answer/', 'AnswerController@index');
});
/*
 * Difficult Routes
 */
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/difficult/', 'DifficultController@index');
    $router->get('/difficult/{id}', 'DifficultController@show');
    $router->get('/difficult/getQuestions/{id}', 'DifficultController@getQuestions');
});
/*Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('logout', 'UserController@logout');
    Route::post('refresh', 'UserController@refresh');
    Route::post('me', 'UserController@me');
});*/
/*
 * Authentification Routes
 */
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', 'UserController@register');
    $router->post('/login', 'UserController@login');
    $router->post('/logout', 'UserController@logout');
    $router->post('/refresh', 'UserController@refresh');
    $router->post('/me', 'UserController@me');
});
/*
 * Test Routes
 */
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/Test/', 'TestController@get');//old
    $router->post('/Test/', 'TestController@create');//old
    $router->post('/Test/createTest','TestController@createTest');//old
    $router->post('/Test/getTest', 'TestController@gettest');
    $router->post('/Test/finishTest', 'TestController@finishTest');
    $router->post('/Test/createEntryTest','TestController@createEntryTest');
    $router->post('/Test/createExitTest','TestController@getFinaltest');
    $router->get('/Test/{id}', 'TestController@getOne');

});
/*
 * Test Input Routes
 */
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/TestInput/', 'TestInputController@get');
    $router->post('/TestInput/', 'TestInputController@create');
    $router->get('/TestInput/{id}', 'TestController@getOne');
    $router->put('/TestInput/{id}', 'AnswerController@update');
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/Gender/', 'GenderController@get');
    $router->post('/Gender/', 'GenderController@create');
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/self/', 'selfAssessmentController@get');
    $router->post('/self/', 'selfAssessmentController@create');
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/profession/', 'ProfessionController@get');
    $router->post('/profession/', 'ProfessionController@create');
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/classification/category', 'ClassificationController@getSpecific');
    $router->post('/classification/','ClassificationController@create');
    $router->get('/classification/{id}', 'ClassificationController@getAllFromUser');
});
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/user/classification', 'UserController@getClassification');
    $router->get('/user/selfAssessment','UserController@getSelfAssessment');
    $router->get('/user/job','UserController@job');
});
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/job/', 'JobController@get');
    $router->post('/job/','JobController@create');
});
