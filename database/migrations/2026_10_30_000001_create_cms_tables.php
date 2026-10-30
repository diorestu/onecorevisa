<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', fn (Blueprint $table) => $table->boolean('is_admin')->default(false));
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('slug')->unique();
            $table->string('source_key')->nullable();
            $table->json('translations');
            $table->json('details')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('slug')->unique();
            $table->json('translations');
            $table->json('details')->nullable();
            $table->json('pricing')->nullable();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->restrictOnDelete();
            $table->string('slug')->unique();
            $table->json('translations');
            $table->string('image')->nullable();
            $table->string('status')->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });
        foreach (['copy_texts', 'page_contents'] as $name) {
            Schema::create($name, function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->string('group');
                $table->string('label');
                $table->json('translations');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        foreach (['copy_texts', 'page_contents', 'articles', 'services', 'categories'] as $name) {
            Schema::dropIfExists($name);
        }
        Schema::table('users', fn (Blueprint $table) => $table->dropColumn('is_admin'));
    }
};
