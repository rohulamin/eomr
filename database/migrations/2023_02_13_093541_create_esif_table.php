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
        Schema::create('esif', function (Blueprint $table) {
             $table->id();
           $table->string('REGISTRATION_NO',15);
            $table->string('STUDENT_NAME',100);
           $table->string('FATHERS_NAME',100);
            $table->string('MOTHERS_NAME',100);
            $table->string('ADMISSION_SESSION');
            $table->string('STUDENT_GROUP');
            $table->string('SUBJECT_CODE',100)->nullable();
            $table->string('STUDENT_TYPE',100);
            $table->string('MADRASAH_EIIN');
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
        Schema::dropIfExists('esif');
    }
};
