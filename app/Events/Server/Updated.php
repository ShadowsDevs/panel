<?php

namespace Shadowdactyl\Events\Server;

use Shadowdactyl\Events\Event;
use Shadowdactyl\Models\Server;
use Illuminate\Queue\SerializesModels;

class Updated extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Server $server)
    {
    }
}
