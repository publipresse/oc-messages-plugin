<?php namespace Publipresse\Messages\Components;

use Publipresse\Messages\Classes\ComponentShared;

/**
 * Fancybox Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Fancybox extends ComponentShared {

    public function componentDetails() {
        return [
            'name' => 'Fancybox',
            'description' => 'Display messages in a fancybox'
        ];
    }

    public function onRun() {
        parent::onRun();
        if($this->records->count() > 0) {
            $this->page->addCss('assets/vendor/fancybox/fancybox/fancybox.css');
            $this->page->addJs('assets/vendor/fancybox/fancybox/fancybox.umd.js', ['defer' => true]);
            $this->page->addJs('/plugins/publipresse/messages/assets/fancybox.js', ['defer' => true]);
        }
    }
}
