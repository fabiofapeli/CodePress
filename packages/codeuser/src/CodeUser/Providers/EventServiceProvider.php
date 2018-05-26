<?php

namespace CodePress\CodeUser\Providers;

use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeUser\Listener\EmailCreatedAccountListener;
use CodePress\CodeUser\Listener\TestEventListener;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
         //nesse modelo não tem como atribuir prioridade de execução para os listener
        UserCreatedEvent::class => [
            EmailCreatedAccountListener::class
        ]
    ];

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
