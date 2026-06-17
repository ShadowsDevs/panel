<?php

namespace Shadowdactyl\Http\Requests\Api\Client\Servers\Files;

use Shadowdactyl\Models\Permission;
use Shadowdactyl\Http\Requests\Api\Client\ClientApiRequest;

class UploadFileRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_CREATE;
    }
}
