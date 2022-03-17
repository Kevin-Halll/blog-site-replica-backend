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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
            $table->foreignId('company_id')
                    ->constrained('companies')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('star_rating');
            $table->string('title');
            $table->text('content');
            $table->integer('helpful_count')->default(0)->nullable(true);
            $table->integer('not_helpful_count')->default(0)->nullable(true);
            $table->boolean('is_active')->default(true)->nullable(false);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
