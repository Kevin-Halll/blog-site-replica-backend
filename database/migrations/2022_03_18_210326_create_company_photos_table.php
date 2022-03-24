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
            $table->integer('review_id')
                ->nullable()
                ->constrained('reviews')
                ->onUpdate('cascade');
            $table->string('file_path');
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
