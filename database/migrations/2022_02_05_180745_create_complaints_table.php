<?php

use App\Models\Complaint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status', [Complaint::STATUS_RESOLVED, Complaint::STATUS_UNASSIGNED, Complaint::STATUS_ACTIVE])->default(Complaint::STATUS_UNASSIGNED);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}
