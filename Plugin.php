<?php namespace NiaInteractive\NiaPays;

use Backend;
use System\Classes\PluginBase;
use Schema;
use Illuminate\Database\Schema\Blueprint;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'NiaPays',
            'description' => 'Donation management plugin',
            'author' => 'NiaInteractive',
            'icon' => 'icon-leaf'
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        // Create the donations table if it doesn't exist
        if (!Schema::hasTable('niainteractive_niapays_donations')) {
            Schema::create('niainteractive_niapays_donations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->decimal('amount', 10, 2)->nullable();
                $table->string('stripe_payment_intent_id')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }
    }

    public function registerComponents()
    {
        return [
            \NiaInteractive\NiaPays\Components\DonationForm::class => 'donationForm'
        ];
    }

    public function registerNavigation()
    {
        return [
            'niapays' => [
                'label' => 'NiaPays',
                'url' => Backend::url('niainteractive/niapays/donation'),
                'icon' => 'icon-leaf',
                'permissions' => ['niainteractive.niapays.*'],
                'order' => 500,
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'niapayssettings' => [
                'label'       => 'NiaPays Settings',
                'description' => 'Manage Stripe API keys for donations.',
                'category'    => 'NiaPays',
                'icon'        => 'icon-credit-card',
                'class'       => 'NiaInteractive\NiaPays\Models\Settings',
                'order'       => 500,
                'keywords'    => 'stripe donation payment',
                'permissions' => ['niainteractive.niapays.settings'],
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'niainteractive.niapays.settings' => [
                'tab' => 'NiaPays',
                'label' => 'Manage NiaPays Settings'
            ],
            'niainteractive.niapays.*' => [
                'tab' => 'NiaPays',
                'label' => 'Access NiaPays'
            ],
        ];
    }
}