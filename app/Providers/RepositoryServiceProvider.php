<?php

namespace Shadowdactyl\Providers;

use Illuminate\Support\ServiceProvider;
use Shadowdactyl\Repositories\Eloquent\EggRepository;
use Shadowdactyl\Repositories\Eloquent\NestRepository;
use Shadowdactyl\Repositories\Eloquent\NodeRepository;
use Shadowdactyl\Repositories\Eloquent\TaskRepository;
use Shadowdactyl\Repositories\Eloquent\UserRepository;
use Shadowdactyl\Repositories\Eloquent\ApiKeyRepository;
use Shadowdactyl\Repositories\Eloquent\ServerRepository;
use Shadowdactyl\Repositories\Eloquent\SessionRepository;
use Shadowdactyl\Repositories\Eloquent\SubuserRepository;
use Shadowdactyl\Repositories\Eloquent\DatabaseRepository;
use Shadowdactyl\Repositories\Eloquent\LocationRepository;
use Shadowdactyl\Repositories\Eloquent\ScheduleRepository;
use Shadowdactyl\Repositories\Eloquent\SettingsRepository;
use Shadowdactyl\Repositories\Eloquent\AllocationRepository;
use Shadowdactyl\Contracts\Repository\EggRepositoryInterface;
use Shadowdactyl\Repositories\Eloquent\EggVariableRepository;
use Shadowdactyl\Contracts\Repository\NestRepositoryInterface;
use Shadowdactyl\Contracts\Repository\NodeRepositoryInterface;
use Shadowdactyl\Contracts\Repository\TaskRepositoryInterface;
use Shadowdactyl\Contracts\Repository\UserRepositoryInterface;
use Shadowdactyl\Repositories\Eloquent\DatabaseHostRepository;
use Shadowdactyl\Contracts\Repository\ApiKeyRepositoryInterface;
use Shadowdactyl\Contracts\Repository\ServerRepositoryInterface;
use Shadowdactyl\Repositories\Eloquent\ServerVariableRepository;
use Shadowdactyl\Contracts\Repository\SessionRepositoryInterface;
use Shadowdactyl\Contracts\Repository\SubuserRepositoryInterface;
use Shadowdactyl\Contracts\Repository\DatabaseRepositoryInterface;
use Shadowdactyl\Contracts\Repository\LocationRepositoryInterface;
use Shadowdactyl\Contracts\Repository\ScheduleRepositoryInterface;
use Shadowdactyl\Contracts\Repository\SettingsRepositoryInterface;
use Shadowdactyl\Contracts\Repository\AllocationRepositoryInterface;
use Shadowdactyl\Contracts\Repository\EggVariableRepositoryInterface;
use Shadowdactyl\Contracts\Repository\DatabaseHostRepositoryInterface;
use Shadowdactyl\Contracts\Repository\ServerVariableRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register all the repository bindings.
     */
    public function register(): void
    {
        // Eloquent Repositories
        $this->app->bind(AllocationRepositoryInterface::class, AllocationRepository::class);
        $this->app->bind(ApiKeyRepositoryInterface::class, ApiKeyRepository::class);
        $this->app->bind(DatabaseRepositoryInterface::class, DatabaseRepository::class);
        $this->app->bind(DatabaseHostRepositoryInterface::class, DatabaseHostRepository::class);
        $this->app->bind(EggRepositoryInterface::class, EggRepository::class);
        $this->app->bind(EggVariableRepositoryInterface::class, EggVariableRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(NestRepositoryInterface::class, NestRepository::class);
        $this->app->bind(NodeRepositoryInterface::class, NodeRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(ServerRepositoryInterface::class, ServerRepository::class);
        $this->app->bind(ServerVariableRepositoryInterface::class, ServerVariableRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(SubuserRepositoryInterface::class, SubuserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
