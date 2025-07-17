<?php namespace NiaInteractive\NiaPays;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'NiaPays',
            'description' => 'No description provided yet...',
            'author' => 'NiaInteractive',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {

        return [
            \NiaInteractive\NiaPays\Components\DonationForm::class => 'donationForm'
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'niainteractive.niapays.some_permission' => [
                'tab' => 'NiaPays',
                'label' => 'Some permission'
            ],
        ];
    }

    // 
    // register Settings in the backend
    // 



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



    /**
     * registerNavigation used by the backend.
     */
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
}
