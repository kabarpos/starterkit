<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('properties')) {
            Schema::create('properties', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description');
                $table->decimal('price', 12, 2);
                $table->integer('bedrooms');
                $table->integer('bathrooms');
                $table->decimal('area', 10, 2);
                $table->string('location');
                $table->string('status');
                $table->string('type');
                $table->integer('year_built')->nullable();
                $table->integer('garage')->nullable();
                $table->boolean('is_featured')->default(false);
                $table->timestamps();
            });
        } else if (!Schema::hasColumn('properties', 'is_featured')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->boolean('is_featured')->default(false);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('properties')) {
            if (Schema::hasColumn('properties', 'is_featured')) {
                Schema::table('properties', function (Blueprint $table) {
                    $table->dropColumn('is_featured');
                });
            }
        }
    }
};
