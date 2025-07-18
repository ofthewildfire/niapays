<?php namespace NiaInteractive\NiaPays;

use Backend;
use System\Classes\PluginBase;
use Schema;

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
        //
    }

    public function registerComponents()
    {
        // Only register if table exists
        if (Schema::hasTable('niainteractive_niapays_donations')) {
            return [
                \NiaInteractive\NiaPays\Components\DonationForm::class => 'donationForm'
            ];
        }
        return [];
    }

    public function registerSettings()
    {
        // Settings are safe to register immediately - they use system_settings table
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

    public function registerNavigation()
    {
        // Only register navigation if table exists
        if (Schema::hasTable('niainteractive_niapays_donations')) {
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
        return [];
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