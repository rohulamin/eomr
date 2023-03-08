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
        Schema::create('receiveomrs', function (Blueprint $table) {
           $table->id();
           $table->string('CENTER_CODE',3);
            $table->string('CENTER_EIIN',100)->nullable();
           $table->string('DISTRICT',100)->nullable();
            $table->string('THANA',100)->nullable();
            $table->string('PHONE')->nullable();
            $table->string('SUBJECT_CODE');
            $table->string('BIMA_NO',200);
            $table->string('BIMA_DATE',100);
            $table->date('ENTRY_DATE',100);              
            $table->integer('ENTRY_OMR')->unsigned();
            $table->string('REST_OMR',100)->nullable();
            $table->string('INSERTED_BY',100)->nullable();
            $table->string('UPDATED_BY',100)->nullable();
            $table->string('MADRASAH_NAME')->nullable();
            $table->timestamps();          
        });


DB::table('receiveomrs')->insert(
        array(
            'CENTER_CODE' => '151',
            'SUBJECT_CODE' => '501101',
            'BIMA_NO' => '0000',
            'BIMA_DATE' => '0000',
            'ENTRY_DATE' => '2023-03-08',
            'ENTRY_OMR' => '1',
            'REST_OMR' => '99',
            'INSERTED_BY' => 'system'
        )
    );


    }

    
     /* Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receiveomrs');
    }
};
