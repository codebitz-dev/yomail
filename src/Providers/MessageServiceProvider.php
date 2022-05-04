<?php
namespace Codebitz\Yomail\Providers;

use Codebitz\Yomail\Listeners\YoMailListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Mail\Events\MessageSending;

class MessageServiceProvider extends EventServiceProvider
{
    protected $listen = [
        MessageSending::class => [
            YoMailListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
?>
