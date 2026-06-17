<?php

namespace Shadowdactyl\Http\Requests\Api\Application\Allocations;

use Shadowdactyl\Services\Acl\Api\AdminAcl;
use Shadowdactyl\Http\Requests\Api\Application\ApplicationApiRequest;

class DeleteAllocationRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_ALLOCATIONS;

    protected int $permission = AdminAcl::WRITE;
}
