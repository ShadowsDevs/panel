<?php

namespace Shadowdactyl\Events\Subuser;

use Shadowdactyl\Events\Event;
use Shadowdactyl\Models\Subuser;
use Illuminate\Queue\SerializesModels;

class Created extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Subuser $subuser)
    {
    }
}
