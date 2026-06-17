<?php

namespace Shadowdactyl\Http\Requests\Api\Client\Servers\Settings;

use Shadowdactyl\Models\Permission;
use Shadowdactyl\Http\Requests\Api\Client\ClientApiRequest;

class ReinstallServerRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SETTINGS_REINSTALL;
    }
}
