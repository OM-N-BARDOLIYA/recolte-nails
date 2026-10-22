<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('source')->nullable()->default('whatsapp_product')->after('subject');
            $table->string('type')->nullable()->default('whatsapp')->after('source');
            $table->json('metadata')->nullable()->after('type');
            $table->string('ip_address')->nullable()->after('admin_notes');
        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['source', 'type', 'metadata', 'ip_address']);
        });
    }
};
