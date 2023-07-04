<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->integer('user_id')->nullable();
            $table->longText('content');
            $table->enum('status', [
                'new',
                'open',
                'pending',
                'on-hold',
                'solved',
                'closed'
            ]);
            

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->datetime('closed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
