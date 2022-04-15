<?php

use App\Services\Constants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCubeDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cube_data', function (Blueprint $table) {
            $table->id();
            $table->json('matrix');
            $table->enum('direction', Constants::DIRECTIONS);
            $table->enum('degree', array_keys(Constants::DEGREES));
            $table->enum('side', Constants::SIDES);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cube_data');
    }
}
