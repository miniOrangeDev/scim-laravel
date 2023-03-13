<?php

use Illuminate\Support\Facades\Route;

Route::get('mo_scim_admin', 'MoScim\Classes\Actions\MoScimAdminController@launch');

Route::get('mo_scim_register.php', 'MoScim\Classes\Actions\MoScimRegisterController@launch');
Route::post('mo_scim_register.php', 'MoScim\Classes\Actions\MoScimRegisterController@launch');

Route::get('mo_scim_account.php', 'MoScim\Classes\Actions\MoScimAccountController@launch');
Route::post('mo_scim_account.php', 'MoScim\Classes\Actions\MoScimAccountController@launch');

Route::get('mo_scim_admin_login.php', 'MoScim\Classes\Actions\MoScimAdminLoginController@launch');
Route::post('mo_scim_admin_login.php', 'MoScim\Classes\Actions\MoScimAdminLoginController@launch');

Route::get('mo_scim_setup.php', 'MoScim\Classes\Actions\MoScimSetupController@launch');
Route::post('mo_scim_setup.php', 'MoScim\Classes\Actions\MoScimSetupController@launch');

Route::get('mo_scim_admin_logout.php', 'MoScim\Classes\Actions\MoScimAdminLogoutController@launch');

Route::get('mo_scim_how_to_setup.php', 'MoScim\Classes\Actions\MoScimHowToSetupController@launch');
Route::post('mo_scim_how_to_setup.php', 'MoScim\Classes\Actions\MoScimHowToSetupController@launch');

Route::get('mo_scim_support.php', 'MoScim\Classes\Actions\MoScimSupportController@launch');
Route::post('mo_scim_support.php', 'MoScim\Classes\Actions\MoScimSupportController@launch');

Route::get('mo_scim_trial.php', 'MoScim\Classes\Actions\MoScimTrialsController@launch');
Route::post('mo_scim_trial.php', 'MoScim\Classes\Actions\MoScimTrialsController@launch');

Route::get('mo_scim_create_tables', 'MoScim\Classes\Actions\MoScimDatabaseController@createTables');


// scim specific urls
Route::get('try', 'MoScim\Classes\Actions\MoScimSetupController@try');
Route::get('scimSetUpPage', 'MoScim\Classes\Actions\MoScimSetupController@scimSetUpPage');
Route::post('attributeMapping', 'MoScim\Classes\Actions\MoScimSetupController@attributeMapping');
Route::post('generate-new-token', 'MoScim\Classes\Actions\MoScimSetupController@generateNewToken');



Route::group([
    
    'prefix' => 'scim/v2'

], function () {

    Route::get('greeting', function () {
        return 'Hello World';
    });
    
    Route::get('Users/{id}', 'MoScim\Classes\Actions\MoScimController@getUserById');
    Route::get('Users', 'MoScim\Classes\Actions\MoScimController@getUsers');
    
    Route::post('Users', 'MoScim\Classes\Actions\MoScimController@postUsers');
    Route::put('Users/{id}', 'MoScim\Classes\Actions\MoScimController@putUserById');
    Route::delete('Users/{id}', 'MoScim\Classes\Actions\MoScimController@deleteUserById');

});