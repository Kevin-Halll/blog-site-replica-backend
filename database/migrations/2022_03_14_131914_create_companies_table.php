<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_claimed')->default(false)->nullable(false);
            $table->string('name');
            $table->string('description');
            $table->string('email');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->string('menu_url')->nullable();
            $table->string('category_ids')->nullable();
            $table->text('amenities')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_active')->default(true)->nullable(false);
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
        Schema::dropIfExists('companies');
    }
};
