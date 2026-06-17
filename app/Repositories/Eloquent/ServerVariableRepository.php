<?php

namespace Shadowdactyl\Repositories\Eloquent;

use Shadowdactyl\Models\ServerVariable;
use Shadowdactyl\Contracts\Repository\ServerVariableRepositoryInterface;

class ServerVariableRepository extends EloquentRepository implements ServerVariableRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return ServerVariable::class;
    }
}
