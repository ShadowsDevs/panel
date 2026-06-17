<?php

namespace Shadowdactyl\Http\Requests\Api\Client\Servers\Backups;

use Shadowdactyl\Models\Permission;
use Shadowdactyl\Http\Requests\Api\Client\ClientApiRequest;

class RestoreBackupRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_BACKUP_RESTORE;
    }

    public function rules(): array
    {
        return ['truncate' => 'required|boolean'];
    }
}
