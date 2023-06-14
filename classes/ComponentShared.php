<?php

namespace Publipresse\Messages\Classes;

use Cms\Classes\ComponentBase;

use Tailor\Components\CollectionComponent;
use Tailor\Models\EntryRecord;

use Cookie;
use Carbon\Carbon;

abstract class ComponentShared extends ComponentBase {

    public $records;
    public $cookie;

    public function defineProperties() {
        return [
            'handle' => [
                'title' => 'Handle',
                'type' => 'dropdown',
                'showExternalParam' => false
            ],
            'cookie' => [
                'title' => 'Cookie lifetime',
                'type' => 'string',
                'description' => 'Lifetime (in hour) for the cookie that prevent the messages to be displayed, if set to 0, message will always appears.',
                'default' => 24,
                'showExternalParam' => false,
                'validation' => [
                    'integer' => [
                        'allowNegative' => true,
                    ]
                ],
            ],
        ];
    }

    public function getHandleOptions() {
        return (new CollectionComponent)->getHandleOptions();
    }

    public function onRun() {
        // Get records
        $handle = $this->property('handle');
        $records = EntryRecord::inSection($handle)->applyVisibleFrontend();
        $this->records = $this->page['records'] = $records->get();

        // Calculate cookie
        $cookie = Cookie::get($this->alias.'_closed');
        if($cookie) {
            $now = Carbon::now()->toDateTimeString();
            $cookie = Carbon::parse($cookie);
            $lifetime = $cookie->addHours($this->property('cookie'))->toDateTimeString();
            $this->cookie = $now < $lifetime;
        }
    }

    public function onClose() {
        Cookie::queue($this->alias.'_closed', Carbon::now()->toDateTimeString(), 525600);
    }

}