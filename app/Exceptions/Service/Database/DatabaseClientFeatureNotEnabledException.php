<?php

namespace Shadowdactyl\Exceptions\Service\Database;

use Shadowdactyl\Exceptions\ShadowdactylException;

class DatabaseClientFeatureNotEnabledException extends ShadowdactylException
{
    public function __construct()
    {
        parent::__construct('Client database creation is not enabled in this Panel.');
    }
}
