<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponceTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responce_text', function (Blueprint $table) {
            $table->increments('id');
			$table->enum('responce_type', ['error','success','notification'])->default('error');
			$table->string('slug')->nullable()->default("");
			$table->text('desc')->nullable();
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responce_text');
    }
}
