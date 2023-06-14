<?php namespace Publipresse\Messages\Components;

use Publipresse\Messages\Classes\ComponentShared;

/**
 * Banner Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Banner extends ComponentShared
{
    public function componentDetails() {
        return [
            'name' => 'Banner',
            'description' => 'Display messages in a banner'
        ];
    }

    public function onRun() {
        parent::onRun();
        $this->page->addJs('assets/vendor/marquee/marquee3k.js', ['defer' => true]);
        $this->page->addJs('/plugins/publipresse/messages/assets/marquee.js', ['defer' => true]);
    }

    public function defineProperties() {
        $sharedProperties = parent::defineProperties();
        $newProperties = [
            'speed' => [
                'title' => 'Speed',
                'type' => 'string',
                'default' => '0.25',
                'validation' => [
                    'required' => [
                        'message' => 'Speed is required'
                    ],
                ]
            ],
            'reverse' => [
                'title' => 'Reverse',
                'type' => 'checkbox',
                'default' => false,
            ],
            'pause' => [
                'title' => 'Pause on hover',
                'type' => 'checkbox',
                'default' => false,
            ],
        ];
        return array_merge($sharedProperties, $newProperties);
    }
}
