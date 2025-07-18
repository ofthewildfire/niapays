<?php namespace Fuascailtdev\NiaPays;

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
            'author' => 'Fuascailtdev',
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
        if (!Schema::hasTable('Fuascailtdev_niapays_donations')) {
            Schema::create('Fuascailtdev_niapays_donations', function (Blueprint $table) {
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
            \Fuascailtdev\NiaPays\Components\DonationForm::class => 'donationForm'
        ];
    }

    public function registerNavigation()
    {
        return [
            'niapays' => [
                'label' => 'NiaPays',
                'url' => Backend::url('Fuascailtdev/niapays/donation'),
                'icon' => 'icon-leaf',
                'permissions' => ['Fuascailtdev.niapays.*'],
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
                'class'       => 'Fuascailtdev\NiaPays\Models\Settings',
                'order'       => 500,
                'keywords'    => 'stripe donation payment',
                'permissions' => ['Fuascailtdev.niapays.settings'],
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'Fuascailtdev.niapays.settings' => [
                'tab' => 'NiaPays',
                'label' => 'Manage NiaPays Settings'
            ],
            'Fuascailtdev.niapays.*' => [
                'tab' => 'NiaPays',
                'label' => 'Access NiaPays'
            ],
        ];
    }
}