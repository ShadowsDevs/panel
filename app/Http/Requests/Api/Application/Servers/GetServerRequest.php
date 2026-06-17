<?php

namespace Shadowdactyl\Http\Requests\Api\Application\Servers;

use Shadowdactyl\Services\Acl\Api\AdminAcl;
use Shadowdactyl\Http\Requests\Api\Application\ApplicationApiRequest;

class GetServerRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_SERVERS;

    protected int $permission = AdminAcl::READ;
}
