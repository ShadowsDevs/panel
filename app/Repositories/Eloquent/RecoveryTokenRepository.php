<?php

namespace Shadowdactyl\Repositories\Eloquent;

use Shadowdactyl\Models\RecoveryToken;

class RecoveryTokenRepository extends EloquentRepository
{
    public function model(): string
    {
        return RecoveryToken::class;
    }
}
