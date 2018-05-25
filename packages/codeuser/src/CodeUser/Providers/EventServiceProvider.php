<?php

namespace CodePress\CodeUser\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use CodePress\CodeUser\Listener\TestEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];
    protected $subscribe = [
        TestEventListener::class
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    // DispatcherContract é uma espécie de controlador dos eventos do framework
    public function boot(DispatcherContract $events) 
    {
        parent::boot($events);
    }
}
