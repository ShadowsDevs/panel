<?php

namespace Shadowdactyl\Repositories\Eloquent;

use Shadowdactyl\Models\User;
use Shadowdactyl\Contracts\Repository\UserRepositoryInterface;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Return the model backing this repository.
     */
    public function model(): string
    {
        return User::class;
    }
}
