<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoScimCreateMiniorangeTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(isset($_SERVER['HTTP_HOST'])){

            if( !Schema::hasTable('mo_scim_config') ) {
                Schema::create('mo_scim_config', function (Blueprint $table) {
                    $table->id()->unique()->startingValue(1);
                    $table->text('mo_scim_domain_name', 100)->nullable();
                    $table->text('mo_scim_host_name', 100)->nullable();
                    $table->text('mo_scim_message', 300)->nullable();
                });
            }
            
            if( !Schema::hasTable('mo_scim_admin') ) {
                Schema::create('mo_scim_admin', function (Blueprint $table) {
                    $table->id()->unique()->startingValue(1);
                    $table->text('mo_scim_domain_name', 100)->nullable();
                    $table->text('email', 100)->nullable();
                    $table->text('password', 100)->nullable();
                });
            }
    
            if( !Schema::hasTable('mo_scim_customer_details') ) {
                Schema::create('mo_scim_customer_details', function (Blueprint $table) {
                    $table->id()->unique()->startingValue(1);
                    $table->text('mo_scim_domain_name', 100)->nullable();
                    $table->text('mo_scim_admin_email', 100)->nullable();
                    $table->text('mo_scim_admin_password', 255)->nullable();
                    $table->text('mo_scim_admin_customer_key', 100)->nullable();
                    $table->text('mo_scim_admin_api_key', 100)->nullable();
                    $table->text('mo_scim_customer_token', 100)->nullable();
                    $table->text('mo_scim_free_version', 255)->nullable();
                    $table->text('mo_scim_registration_status', 100)->nullable();
                    $table->text('vl_check_t', 100)->nullable();
                    $table->text('sml_lk', 100)->nullable();
                    $table->text('mo_scim_message', 100)->nullable();
                    $table->text('mo_scim_use_case', 300)->nullable();
                    $table->text('mo_scim_new_registration', 10)->nullable();
                    $table->text('mo_scim_admin_phone', 20)->nullable();
                    $table->text('mo_scim_verify_customer', 10)->nullable();
                    $table->text('mo_scim_transactionId', 255)->nullable();
                    $table->text('mo_scim_guest_enabled', 10)->nullable();
                    $table->text('site_ck_l', 100)->nullable();
                    $table->text('t_site_status', 100)->nullable();
                });
            }
    
            $tables = [
                'mo_scim_config',
                'mo_scim_admin',
                'mo_scim_customer_details'
            ];
            foreach ($tables as $table) {
                DB::statement('ALTER TABLE ' . $table . ' ENGINE = InnoDB');
            }
            $domain_name = $this->scim_get_current_domain();
            DB::statement("INSERT INTO mo_scim_config(mo_scim_domain_name,mo_scim_host_name) VALUES('".$domain_name."','https://login.xecurify.com/')");
            DB::insert("INSERT INTO mo_scim_admin(mo_scim_domain_name) VALUES('".$domain_name."')");
            DB::insert("INSERT INTO mo_scim_customer_details(mo_scim_domain_name) VALUES('".$domain_name."')");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('mo_scim_config');
    //     Schema::dropIfExists('mo_scim_admin');
    //     Schema::dropIfExists(('mo_scim_customer_details'));
    // }

    function scim_get_current_domain()
    {
        $http_host = $_SERVER['HTTP_HOST'];
        if (substr($http_host, -1) == '/') {
            $http_host = substr($http_host, 0, -1);
        }
        $request_uri = $_SERVER['REQUEST_URI'];
        if (substr($request_uri, 0, 1) == '/') {
            $request_uri = substr($request_uri, 1);
        }

        $is_https = (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') == 0);
        $relay_state = 'http' . ($is_https ? 's' : '') . '://' . $http_host;
        return $relay_state;
    }
}