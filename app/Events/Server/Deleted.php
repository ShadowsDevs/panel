<?php

namespace Shadowdactyl\Events\Server;

use Shadowdactyl\Events\Event;
use Shadowdactyl\Models\Server;
use Illuminate\Queue\SerializesModels;

class Deleted extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Server $server)
    {
    }
}
