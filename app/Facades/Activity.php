<?php

namespace Shadowdactyl\Facades;

use Illuminate\Support\Facades\Facade;
use Shadowdactyl\Services\Activity\ActivityLogService;

class Activity extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogService::class;
    }
}
