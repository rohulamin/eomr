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
        Schema::create('subjects', function (Blueprint $table) {
             $table->id();
            $table->string('SUBJECT_CODE', 6);
            $table->string('SUBJECT_NAME', 200);
             $table->string('GROUP_CODE', 200);
            $table->timestamps();
        });
    

Artisan::call('db:seed', [
        '--class' => 'SubjectSeeder',
    ]);
}
    /**
     * Reverse the migrations.
     *GROUP_CODE
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
