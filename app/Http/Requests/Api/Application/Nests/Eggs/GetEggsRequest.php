<?php

namespace Shadowdactyl\Http\Requests\Api\Application\Nests\Eggs;

use Shadowdactyl\Services\Acl\Api\AdminAcl;
use Shadowdactyl\Http\Requests\Api\Application\ApplicationApiRequest;

class GetEggsRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_EGGS;

    protected int $permission = AdminAcl::READ;
}
