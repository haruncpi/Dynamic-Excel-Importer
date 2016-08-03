<?php
Route::group(['prefix' => 'api'], function () {
    Route::get('databases', ['as' => 'apiDatabasesRoute', 'uses' => 'Import\ApiImportController@getDatabases']);
    Route::get('databases/{db}', ['as' => 'apiTablesRoute', 'uses' => 'Import\ApiImportController@getTables']);
    Route::get('databases/{db}/{tbl}', ['as' => 'apiFieldsRoute', 'uses' => 'Import\ApiImportController@getFields']);
});


Route::get('/', ['as' => 'homepageRoute', 'uses' => 'Import\ImportController@home']);
Route::get('/import', ['as' => 'importRoute', 'uses' => 'Import\ImportController@import']);
Route::get('/reset-import-data', ['as' => 'resetImportRoute', 'uses' => 'Import\ImportController@reset']);
Route::post('/file-upload', ['as' => 'uploadFileRoute', 'uses' => 'Import\ImportController@postImport']);
Route::post('/import-process', ['as' => 'importProcessRoute', 'uses' => 'Import\ImportController@postImportProcess']);


Route::controllers(['auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController',]);

