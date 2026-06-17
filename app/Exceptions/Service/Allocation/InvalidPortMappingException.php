<?php

namespace Shadowdactyl\Exceptions\Service\Allocation;

use Shadowdactyl\Exceptions\DisplayException;

class InvalidPortMappingException extends DisplayException
{
    /**
     * InvalidPortMappingException constructor.
     */
    public function __construct(mixed $port)
    {
        parent::__construct(trans('exceptions.allocations.invalid_mapping', ['port' => $port]));
    }
}
