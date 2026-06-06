<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->timestamp('scheduled_at')->nullable()->after('published_at');
        });

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE blogs MODIFY COLUMN status ENUM('draft', 'published', 'scheduled') NOT NULL DEFAULT 'draft'");
        }
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('scheduled_at');
        });

        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE blogs MODIFY COLUMN status ENUM('draft', 'published') NOT NULL DEFAULT 'draft'");
        }
    }
};
