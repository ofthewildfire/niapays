<?php namespace Fuascailtdev\NiaPays\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code for this settings model
    public $settingsCode = 'fuascailtdev_niapays_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';



    public function getStripeSuccessRedirectOptions()
{
    $pages = \Cms\Classes\Page::listInTheme(\Cms\Classes\Theme::getActiveTheme());
    $options = [];
    foreach ($pages as $page) {
        $options[$page->url] = $page->title . ' (' . $page->url . ')';
    }
    return $options;
}

}