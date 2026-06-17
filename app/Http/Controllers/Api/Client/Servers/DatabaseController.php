<?php

namespace Shadowdactyl\Http\Controllers\Api\Client\Servers;

use Illuminate\Http\Response;
use Shadowdactyl\Models\Server;
use Shadowdactyl\Models\Database;
use Shadowdactyl\Facades\Activity;
use Shadowdactyl\Exceptions\DisplayException;
use Shadowdactyl\Services\Databases\DatabasePasswordService;
use Shadowdactyl\Transformers\Api\Client\DatabaseTransformer;
use Shadowdactyl\Services\Databases\DatabaseManagementService;
use Shadowdactyl\Services\Databases\DeployServerDatabaseService;
use Shadowdactyl\Http\Controllers\Api\Client\ClientApiController;
use Shadowdactyl\Http\Requests\Api\Client\Servers\Databases\GetDatabasesRequest;
use Shadowdactyl\Http\Requests\Api\Client\Servers\Databases\StoreDatabaseRequest;
use Shadowdactyl\Http\Requests\Api\Client\Servers\Databases\DeleteDatabaseRequest;
use Shadowdactyl\Http\Requests\Api\Client\Servers\Databases\RotatePasswordRequest;

class DatabaseController extends ClientApiController
{
    /**
     * DatabaseController constructor.
     */
    public function __construct(
        private DeployServerDatabaseService $deployDatabaseService,
        private DatabaseManagementService $managementService,
        private DatabasePasswordService $passwordService,
    ) {
        parent::__construct();
    }

    /**
     * Return all the databases that belong to the given server.
     */
    public function index(GetDatabasesRequest $request, Server $server): array
    {
        return $this->fractal->collection($server->databases)
            ->transformWith($this->getTransformer(DatabaseTransformer::class))
            ->toArray();
    }

    /**
     * Create a new database for the given server and return it.
     *
     * @throws \Throwable
     * @throws \Shadowdactyl\Exceptions\Service\Database\TooManyDatabasesException
     * @throws \Shadowdactyl\Exceptions\Service\Database\DatabaseClientFeatureNotEnabledException
     */
    public function store(StoreDatabaseRequest $request, Server $server): array
    {
        $database = Activity::event('server:database.create')->transaction(function ($log) use ($request, $server) {
            if ($server->databases()->lockForUpdate()->count() >= $server->database_limit) {
                throw new DisplayException('Cannot create additional databases on this server: limit has been reached.');
            }

            $database = $this->deployDatabaseService->handle($server, $request->validated());

            $log->subject($database)->property('name', $database->database);

            return $database;
        });

        return $this->fractal->item($database)
            ->parseIncludes(['password'])
            ->transformWith($this->getTransformer(DatabaseTransformer::class))
            ->toArray();
    }

    /**
     * Rotates the password for the given server model and returns a fresh instance to
     * the caller.
     *
     * @throws \Throwable
     */
    public function rotatePassword(RotatePasswordRequest $request, Server $server, Database $database): array
    {
        Activity::event('server:database.rotate-password')
            ->subject($database)
            ->property('name', $database->database)
            ->transaction(fn () => $this->passwordService->handle($database));

        return $this->fractal->item($database->refresh())
            ->parseIncludes(['password'])
            ->transformWith($this->getTransformer(DatabaseTransformer::class))
            ->toArray();
    }

    /**
     * Removes a database from the server.
     *
     * @throws \Shadowdactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function delete(DeleteDatabaseRequest $request, Server $server, Database $database): Response
    {
        $this->managementService->delete($database);

        Activity::event('server:database.delete')
            ->subject($database)
            ->property('name', $database->database)
            ->log();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
