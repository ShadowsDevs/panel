<?php

namespace Shadowdactyl\Contracts\Core;

use Shadowdactyl\Events\Event;

interface ReceivesEvents
{
    /**
     * Handles receiving an event from the application.
     */
    public function handle(Event $notification): void;
}
