<?php

namespace Shadowdactyl\Http\Requests\Api\Client\Servers\Schedules;

use Shadowdactyl\Models\Permission;

class DeleteScheduleRequest extends ViewScheduleRequest
{
    public function permission(): string
    {
        return Permission::ACTION_SCHEDULE_DELETE;
    }
}
