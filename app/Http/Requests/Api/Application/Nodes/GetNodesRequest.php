<?php

namespace Shadowdactyl\Http\Requests\Api\Application\Nodes;

use Shadowdactyl\Services\Acl\Api\AdminAcl;
use Shadowdactyl\Http\Requests\Api\Application\ApplicationApiRequest;

class GetNodesRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_NODES;

    protected int $permission = AdminAcl::READ;
}
