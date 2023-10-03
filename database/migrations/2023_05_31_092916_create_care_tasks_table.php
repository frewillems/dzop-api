<?php

use Domain\CareTask\CareTaskStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('care_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('care_goal_id')->references('id')->on('care_goals');
            $table->foreignUuid('assignee_id')->references('id')->on('users');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', CareTaskStatus::values())->default(CareTaskStatus::Todo->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('care_tasks');
    }
};
