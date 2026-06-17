<?php

namespace Shadowdactyl\Facades;

use Illuminate\Support\Facades\Facade;
use Shadowdactyl\Services\Activity\ActivityLogTargetableService;

/**
 * @mixin \Shadowdactyl\Services\Activity\ActivityLogTargetableService
 */
class LogTarget extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogTargetableService::class;
    }
}
