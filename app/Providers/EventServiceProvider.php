<?php

namespace Shadowdactyl\Providers;

use Shadowdactyl\Models\User;
use Shadowdactyl\Models\Server;
use Shadowdactyl\Models\Subuser;
use Shadowdactyl\Models\EggVariable;
use Shadowdactyl\Observers\UserObserver;
use Shadowdactyl\Observers\ServerObserver;
use Shadowdactyl\Observers\SubuserObserver;
use Shadowdactyl\Listeners\TwoFactorListener;
use Shadowdactyl\Listeners\RevocationListener;
use Shadowdactyl\Observers\EggVariableObserver;
use Shadowdactyl\Listeners\AuthenticationListener;
use Shadowdactyl\Events\Server\Installed as ServerInstalledEvent;
use Shadowdactyl\Notifications\ServerInstalled as ServerInstalledNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        ServerInstalledEvent::class => [ServerInstalledNotification::class],
    ];

    protected $subscribe = [
        AuthenticationListener::class,
        RevocationListener::class,
        TwoFactorListener::class,
    ];

    protected static $shouldDiscoverEvents = false;

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();

        User::observe(UserObserver::class);
        Server::observe(ServerObserver::class);
        Subuser::observe(SubuserObserver::class);
        EggVariable::observe(EggVariableObserver::class);
    }
}
