<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inistitutes', function (Blueprint $table) {
            $table->id();
            $table->string('MADRASAH_NAME');
            $table->string('MAD_EIIN');
            $table->string('CENTER_CODE')->nullable();
            $table->string('CENTER_EIIN')->nullable();
            $table->string('SESSION');
            $table->string('GROUP_CODE')->nullable();
            $table->string('GROUP_NAME')->nullable();
             $table->string('DIVISION');
            $table->string('DISTRICT');
            $table->string('THANA');
            $table->string('PHONE')->nullable();
             $table->integer('TOTAL_STUDENTS');
            $table->timestamps();
        });
    

Artisan::call('db:seed', [
        '--class' => 'InistituteSeeder',
    ]);
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inistitutes');
    }
};



