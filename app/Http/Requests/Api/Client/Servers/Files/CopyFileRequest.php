<?php

namespace Shadowdactyl\Http\Requests\Api\Client\Servers\Files;

use Shadowdactyl\Models\Permission;
use Shadowdactyl\Contracts\Http\ClientPermissionsRequest;
use Shadowdactyl\Http\Requests\Api\Client\ClientApiRequest;

class CopyFileRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_CREATE;
    }

    public function rules(): array
    {
        return [
            'location' => 'required|string',
        ];
    }
}
