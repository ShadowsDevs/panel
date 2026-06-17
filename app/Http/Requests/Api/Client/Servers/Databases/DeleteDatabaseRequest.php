<?php

namespace Shadowdactyl\Http\Requests\Api\Client\Servers\Databases;

use Shadowdactyl\Models\Permission;
use Shadowdactyl\Contracts\Http\ClientPermissionsRequest;
use Shadowdactyl\Http\Requests\Api\Client\ClientApiRequest;

class DeleteDatabaseRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_DATABASE_DELETE;
    }
}
