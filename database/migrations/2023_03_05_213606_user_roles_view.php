<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement($this->createFunction());
        //DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::statement("DROP FUNCTION setUserId;");
        //DB::statement("DROP VIEW user_roles;");
    }

    private function createView(): string
    {
        return
            'CREATE VIEW user_roles AS
            SELECT roles.name FROM users usr
                INNER JOIN model_has_roles models_roles ON models_roles.model_id = usr.id
                INNER JOIN roles roles ON roles.id = models_roles.role_id
            WHERE usr.id = setUserId()';
    }

    private function createFunction(): string
    {
        return
                'CREATE FUNCTION setUserId()
                    RETURNS INTEGER DETERMINISTIC NO SQL RETURN @setUserId';
    }
};
