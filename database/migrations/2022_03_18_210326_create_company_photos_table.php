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
        Schema::create('company_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade');
            $table->foreignId('company_id')
                ->constrained('companies')
                ->onUpdate('cascade');
            $table->foreignId('review_id')
                ->constrained('reviews')
                ->onUpdate('cascade')
                ->nullable();
            $table->string('photo_url');
            $table->string('caption')->nullable();
            $table->string('tags')->nullable();
            $table->string('category')->nullalble();
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
        Schema::dropIfExists('company_photos');
    }
};
