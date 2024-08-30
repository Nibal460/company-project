<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_qr_code_path_to_ceos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrCodePathToCeosTable extends Migration
{
    public function up()
    {
        Schema::table('ceos', function (Blueprint $table) {
            $table->string('qr_code_path')->nullable()->after('details');
        });
    }

    public function down()
    {
        Schema::table('ceos', function (Blueprint $table) {
            $table->dropColumn('qr_code_path');
        });
    }
}

