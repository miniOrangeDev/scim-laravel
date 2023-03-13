<?php

namespace MoScim\Classes\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;


class MoScimController extends Controller
{

    public function validateScimBearerToken($request) {
        
        $result = DB::table('mo_scim_free_settings')
                    ->where('option_name', 'scim_bearer_token')
                    ->first();
        
        if (!$result || $request->header('authorization') == null)
            return false;
        
        $bearer_token_string = 'Bearer ' . convert_uudecode($result->option_value);
        // $bearer_token_string = convert_uudecode($result->option_value);

        if ($request->header('authorization') != $bearer_token_string)
            return false;

        return true;
    }

    public function getUserById(Request $request, $id) {

        $validate = $this->validateScimBearerToken($request);
        if (!$validate) {
            $data = 'Invalid Authorization';
            return Response::json($data, 401);
        }
        
        $user = DB::table('users')
                ->where('id', $id)
                ->first();

        if ( !$user ) {
            $data = [
                "schemas"       => ["urn:ietf:params:scim:api:messages:2.0:Error"],
                "detail"        => "User not found"
            ];
            
            return Response::json($data, 404);
        }

        $user->active = true;
        $user->name = ["familyName" => "NULL", "givenName" => "NULL"];
        $user->emails = [
            ["value" => $user->email]
        ];

        $data = [
            "schemas"       => ["urn:ietf:params:scim:schemas:core:2.0:User"],
            "id"            => $user->id,
            "userName"      => $user->email,
            "name"          => $user->name,
            "active"        => $user->active,
            "emails"        => $user->emails
        ];
        
        return Response::json($data, 200);
    }

    public function getUsers(Request $request) {

        $validate = $this->validateScimBearerToken($request);
        if (!$validate) {
            $data = 'Invalid Authorization';
            return Response::json($data, 401);
        }

        $start_index = 1;
        $count = 0;

        if ($request->has('startIndex')) {
            $start_index = $request->query('startIndex');
        }

        if ($request->has('count')) {
            $count = $request->query('count');
        }

        if ($request->has('filter'))
        {
            $filter_string_array = explode(" ", $request->query('filter'));
            $filter_value = str_replace('"', '', $filter_string_array[2]);

            $users = User::where('email', $filter_value)->first();
            
            if (empty($users))
                $users = [];
            else
                $users = [$users];
        }
        else
        {
            $users = User::all();
        }
        
        // returning some fields that are not present in db 
        foreach ($users as $user) {
            $user->active = true;
            $user->name = ["familyName" => "NULL", "givenName" => "NULL"];
            $user->emails = [
                ["value" => $user->email]
            ];
            $user->userName = $user->email;
        }

        $data = [
            "schemas"       => ["urn:ietf:params:scim:api:messages:2.0:ListResponse"],
            "totalResults"  => count($users),
            "startIndex"    => (int)$start_index,
            "itemsPerPage"  => count($users),
            "Resources"     => $users
        ];

        return Response::json($data, 200);
    }

    public function postUsers(Request $request) {

        $validate = $this->validateScimBearerToken($request);
        if (!$validate) {
            $data = 'Invalid Authorization';
            return Response::json($data, 401);
        }

        // Create SCIM user
        $request = json_decode($request->getContent(), true);

        // Add name to database based on the attribute mapping
        $name = $this->getMapping('name');
        $name = $this->mappingForName($name, $request);

        // $name             = $request["name"]["givenName"] . ' ' . $request["name"]["familyName"];
        $email            = $request['emails'][0]['value'];
        
        $existing_user = DB::table('users')
                            ->where('email', $email)
                            ->get();
        
        if (count($existing_user) != 0) {
            $data = [
                "schemas"       => ["urn:ietf:params:scim:api:messages:2.0:Error"],
                "detail"        => "User already exists in the database.",
                "status"        => 409
            ];
            return Response::json($data, 409);

        } else {

            $randomPassword = Hash::make(Str::random(8));
            DB::table('users')->insert(
                [
                    "email"         => $email,
                    "name"          => $name,
                    "password"      => $randomPassword
                ]
            );
            
            $user = User::where('email', $email)->first();

            $active           = $request["active"];
            $name             = $request["name"];
            $userName         = $request["userName"];
            $emails           = $request["emails"];

            $data = [
                "schemas"       => ["urn:ietf:params:scim:schemas:core:2.0:User"],
                "active"        => $active,
                "id"            => $user->id,
                "name"          => $name,
                "userName"      => $userName,
                "emails"        => $emails
            ];

            return Response::json($data, 201);
        }
    }

    public function getMapping($option_name) {
        
        $data = DB::table('mo_scim_free_settings')
                ->where('option_name', $option_name)
                ->first();

        if ($data)
            return $data->option_value;
        
        return '';
    }

    public function mappingForName($name, $request) {
        
        if (str_contains($name, 'name.givenName'))
            $name = $request["name"]["givenName"];
        else if (str_contains($name, 'name.familyName'))
            $name = $request["name"]["familyName"];
        else if (str_contains($name, 'userName'))
            $name = $request["userName"];
        else if (str_contains($name, 'email'))
            $name = $request["emails"][0]["value"];
        else if (str_contains($name, 'displayName'))
            $name = $request["displayName"];
        else if (str_contains($name, 'active'))
            $name = $request["active"];

        return $name;
    }
}