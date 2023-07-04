<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			
			if(!\Schema::hasColumn("users", "first_name")){
				$table->string('first_name')->nullable();
			}
			if(!\Schema::hasColumn("users", "last_name")){
				$table->string('last_name')->nullable();
			}
			if(!\Schema::hasColumn("users", "phone_number")){
				$table->string('phone_number')->nullable();
			}
			
			if(!\Schema::hasColumn("users", "status")){
				$table->enum('status', ['active','inactive'])->default('active');
			}
			if(!\Schema::hasColumn("users", "verified")){
				$table->boolean('verified')->default(false);
			}
			if(!\Schema::hasColumn("users", "week_attendance_in")){
				$table->time('week_attendance_in')->default(0);
			}
			if(!\Schema::hasColumn("users", "week_attendance_out")){
				$table->time('week_attendance_out')->default(0);
			}
			
			if(!\Schema::hasColumn("users", "utype")){
				$table->enum('utype', ['admin','employee'])->default('employee');
			}
			
			
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
