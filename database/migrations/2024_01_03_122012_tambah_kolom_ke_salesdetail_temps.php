<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomKeSalesdetailTemps extends Migration
{
    public function up()
    {
        Schema::table('salesdetail_temps', function (Blueprint $table) {
            $table->integer('spss')->nullable(); 
          
        });
    }

    public function down()
    {
        Schema::table('salesdetail_temps', function (Blueprint $table) {
            $table->dropColumn('spss'); 
        });
    }
}
