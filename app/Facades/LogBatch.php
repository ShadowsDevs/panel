<?php

namespace Shadowdactyl\Facades;

use Illuminate\Support\Facades\Facade;
use Shadowdactyl\Services\Activity\ActivityLogBatchService;

class LogBatch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ActivityLogBatchService::class;
    }
}
