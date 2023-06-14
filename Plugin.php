<?php namespace Publipresse\Messages;

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
            'name' => 'Messages',
            'description' => 'Display messages closable using cookies.',
            'author' => 'Publipresse',
            'icon' => 'icon-bullhorn'
        ];
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            'Publipresse\Messages\Components\Fancybox' => 'fancybox',
            'Publipresse\Messages\Components\Banner' => 'banner',
        ];
    }
}
