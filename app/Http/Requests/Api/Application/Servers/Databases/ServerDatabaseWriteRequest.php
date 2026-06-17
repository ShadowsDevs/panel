<?php

namespace Shadowdactyl\Http\Requests\Api\Application\Servers\Databases;

use Shadowdactyl\Services\Acl\Api\AdminAcl;

class ServerDatabaseWriteRequest extends GetServerDatabasesRequest
{
    protected int $permission = AdminAcl::WRITE;
}
