<?php

namespace Shadowdactyl\Exceptions\Service;

use Illuminate\Http\Response;
use Shadowdactyl\Exceptions\DisplayException;

class HasActiveServersException extends DisplayException
{
    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }
}
