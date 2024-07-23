<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customization', function (Blueprint $table) {
            $table->id();
            $table->enum('color', ['1', '2', '3'])->default('1');
            $table->string('logo_pic')->nullable();
            $table->string('company_name')->nullable();
            $table->timestamps();
        });

        DB::table('customization')->insert([
            'logo_pic' => null,
            'company_name' => null,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('customization');
    }
};
