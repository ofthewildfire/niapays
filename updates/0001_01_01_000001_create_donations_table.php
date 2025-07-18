<?php namespace NiaInteractive\NiaPays\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateDonationsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('niainteractive_niapays_donations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(); // <-- Add this line
            $table->string('email')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('niainteractive_niapays_donations');
    }
};
