<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { 
        Schema::create("projects", function(Blueprint $table){
            $table->id();
            $table->string("name")->nullable();
            $table->string("description")->nullable();
            $table->string("state")->nullable();
            $table->timestamp("start_date")->nullable();
            $table->timestamp("final_date")->nullable();
            $table->timestamp("created_at");
            $table->timestamp("updated_at");

        });
    }

    /***
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("projects");
    }
};
