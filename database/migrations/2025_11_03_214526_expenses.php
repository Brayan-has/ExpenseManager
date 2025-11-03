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
        //
        Schema::create("expenses",function(Blueprint $table){
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->bigInteger("value");
            $table->timestamp("date");
            $table->string("status");
            $table->boolean("daily");
            $table->boolean("by_week");
            $table->boolean("by_month");
            $table->boolean("annual");
            $table->timestamp("created_at");
            $table->timestamp("updated_at");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("expenses");
    }
};
