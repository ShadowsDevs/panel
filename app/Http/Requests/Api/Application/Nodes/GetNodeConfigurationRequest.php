<?php

namespace Shadowdactyl\Http\Requests\Api\Application\Nodes;

use Shadowdactyl\Services\Acl\Api\AdminAcl;

class GetNodeConfigurationRequest extends GetNodesRequest
{
    protected int $permission = AdminAcl::WRITE;
}
