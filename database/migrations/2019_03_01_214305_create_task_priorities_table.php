<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskPrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_priorities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('task');
            $table->string('priority');

          //  $table->foreign('task')->references('task')->on('tasks')->onDelete('cascade');
            //$table->foreign('priority')->references('priority')->on('priorities')->onDelete('cascade');
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_priorities');
    }
}
