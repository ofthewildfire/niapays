<?php namespace Fuascailtdev\NiaPays\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Fuascailtdev_niapays_donations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Fuascailtdev_niapays_donations');
    }
};