<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $collection) {
            $collection->unique('email');
        });

        Schema::create('password_reset_tokens', function (Blueprint $collection) {
            $collection->unique('email');
        });

        Schema::create('sessions', function (Blueprint $collection) {
            $collection->index('user_id');
            $collection->index('lastActivity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasCollection('users')) Schema::drop('users');
        if(Schema::hasCollection('password_reset_tokens')) Schema::drop('password_reset_tokens');
        if(Schema::hasCollection('sessions')) Schema::drop('sessions');
    }
};
