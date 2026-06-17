<?php

namespace Shadowdactyl\Http\Requests\Api\Application\Users;

use Shadowdactyl\Services\Acl\Api\AdminAcl;
use Shadowdactyl\Http\Requests\Api\Application\ApplicationApiRequest;

class GetExternalUserRequest extends ApplicationApiRequest
{
    protected ?string $resource = AdminAcl::RESOURCE_USERS;

    protected int $permission = AdminAcl::READ;
}
