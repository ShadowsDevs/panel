<?php

namespace Shadowdactyl\Http\Requests\Api\Client\Servers\Schedules;

use Shadowdactyl\Models\Permission;

class UpdateScheduleRequest extends StoreScheduleRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SCHEDULE_UPDATE;
    }
}
