<?php

// database/migrations/xxxx_xx_xx_xxxxxx_remove_type_from_managers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTypeFromManagersTable extends Migration
{
    public function up()
    {
        Schema::table('managers', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

    public function down()
    {
        Schema::table('managers', function (Blueprint $table) {
            $table->string('type'); // Re-add the column if rolling back
        });
    }
}
