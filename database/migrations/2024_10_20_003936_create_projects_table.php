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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('project_category_id')->constrained('project_categories');
            $table->string('name');
            $table->string('description');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('team_id')->constrained('teams');
            $table->enum('status', ['todo', 'in_progress', 'completed', 'cancelled'])->default('todo');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('budget')->nullable(false)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
