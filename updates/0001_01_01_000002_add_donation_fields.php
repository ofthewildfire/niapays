<?php namespace NiaInteractive\NiaPays\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('niainteractive_niapays_donations', function(Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('niainteractive_niapays_donations', function(Blueprint $table) {
            $table->dropColumn(['name', 'email', 'amount']);
        });
    }
};