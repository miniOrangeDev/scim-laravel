<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTableName(), function (Blueprint $table) {
            $table->increments('option_id');
            $table->string('option_name');
            $table->string('option_value');
            $table->timestamps();
        });

        // Generate and insert a new default bearer token
        $bearer_token = bin2hex(random_bytes(32));
        $bearer_token = convert_uuencode($bearer_token);

        DB::table('mo_scim_free_settings')->insert(
            [
                "option_name"         => 'scim_bearer_token',
                "option_value"        => $bearer_token
            ]
        );
    }

    public function getTableName()
    {
        return 'mo_scim_free_settings';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->getTableName());
    }
};