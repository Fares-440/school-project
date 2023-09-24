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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('father_name');
            $table->string('national_id_father');
            $table->string('passport_id_father')->nullable();
            $table->string('phone_father');
            $table->string('job_father');
            $table->foreignId('father_nationality_id')->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('father_bloodtype_id')->constrained('type_bloods')->cascadeOnDelete();
            $table->foreignId('father_religion_id')->constrained('religions')->cascadeOnDelete();
            $table->string('father_address');

            //Mother information
            $table->string('mother_name');
            $table->string('national_id_mother');
            $table->string('passport_id_mother')->nullable();
            $table->string('phone_mother');
            $table->string('job_mother');
            $table->foreignId('mother_nationality_id')->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('mother_bloodtype_id')->constrained('type_bloods')->cascadeOnDelete();
            $table->foreignId('mother_religion_id')->constrained('religions')->cascadeOnDelete();
            $table->string('mother_address');
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
        Schema::dropIfExists('parents');
    }
};
