<?php

namespace MoScim\Classes\Actions;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class MoScimSetupController extends Controller {
    
    public function launch() {
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'mo_scim_setup.php';
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'jsLoader.php';
        @include('mo_scim::menuView');
        
        $userColumns = Schema::getColumnListing('users');
        $scimAttributes = [
            'userName', 'name.givenName', 'name.familyName', 'email', 'displayName', 'active'
        ];
        $bearer_token = DB::table('mo_scim_free_settings')
                        ->where('option_name', 'scim_bearer_token')
                        ->first();

        $bearer_token_value = "";
        if (!empty($bearer_token))
            $bearer_token_value = convert_uudecode($bearer_token->option_value);

        $name_option_selected = DB::table('mo_scim_free_settings')
                                ->where('option_name', 'name')
                                ->first();

        if (!empty($name_option_selected))
            $name_option_selected = $name_option_selected->option_value;

        // Log::debug($userColumns);
        return view('mo_scim::setupView')
                ->with('userColumns', $userColumns)
                ->with('name_option_selected', $name_option_selected)
                ->with('scimAttributes', $scimAttributes)
                ->with('bearerToken', $bearer_token_value);
    }

    public function generateNewToken() {

        $this->check_miniorange_session();

        $bearer_token = bin2hex(random_bytes(32));
        $bearer_token = convert_uuencode($bearer_token);

        $data = DB::table('mo_scim_free_settings')
                ->where('option_name', 'scim_bearer_token')
                ->get();

        if (count($data) == 0)
        {
            DB::table('mo_scim_free_settings')->insert(
                [
                    "option_name"         => 'scim_bearer_token',
                    "option_value"        => $bearer_token
                ]
            );
        }
        else
        {
            DB::table('mo_scim_free_settings')
                ->where('option_name', 'scim_bearer_token')
                ->update(
                    [
                        'option_value' => $bearer_token
                    ]
                );
        }

        return back()->with('message', 'Bearer token generated successfully');
    }

    public function attributeMapping(Request $request) {
        
        $this->check_miniorange_session();
        
        if (!$request->name) {
            return redirect()->back()->with('success_message','Please select one of the values from the dropdown');
        }

        $data = DB::table('mo_scim_free_settings')
                ->where('option_name', 'name')
                ->first();

        if (!$data)
        {
            // create new entry
            DB::table('mo_scim_free_settings')->insert(
                [
                    "option_name"         => 'name',
                    "option_value"        => $request->name
                ]
            );

        }
        else
        {
            // update
            DB::table('mo_scim_free_settings')
                ->where('option_name', 'name')
                ->update(
                    [
                        'option_value' => $request->name
                    ]
                );
        }

        return redirect()->back()->with('success_message','Attributes saved successfully!');
    }

    public function check_miniorange_session() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['authorized']) && !empty($_SESSION['authorized'])) {
            if ($_SESSION['authorized'] != true) {
              
                header('Location: mo_scim_admin_login.php');
                exit();
            }
        }
        else {
            header('Location: mo_scim_admin_login.php');
            exit();
        }
    }
}