<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('expense_category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('expense', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('expense_category_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->dateTime('entry_date')->nullable();
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
        Schema::dropIfExists('expense_category');
        Schema::dropIfExists('expense');
    }
}
