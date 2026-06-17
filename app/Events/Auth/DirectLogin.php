<?php

namespace Shadowdactyl\Events\Auth;

use Shadowdactyl\Models\User;
use Shadowdactyl\Events\Event;

class DirectLogin extends Event
{
    public function __construct(public User $user, public bool $remember)
    {
    }
}
