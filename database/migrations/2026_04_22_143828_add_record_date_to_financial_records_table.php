<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('financial_records', function (Blueprint $table) {
        // Allow NULL values so existing rows don’t break
        $table->date('record_date')->nullable()->after('type');
    });
}

public function down(): void
{
    Schema::table('financial_records', function (Blueprint $table) {
        $table->dropColumn('record_date');
    });
}

};
