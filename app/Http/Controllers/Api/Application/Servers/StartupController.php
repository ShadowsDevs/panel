<?php

namespace Shadowdactyl\Http\Controllers\Api\Application\Servers;

use Shadowdactyl\Models\User;
use Shadowdactyl\Models\Server;
use Shadowdactyl\Services\Servers\StartupModificationService;
use Shadowdactyl\Transformers\Api\Application\ServerTransformer;
use Shadowdactyl\Http\Controllers\Api\Application\ApplicationApiController;
use Shadowdactyl\Http\Requests\Api\Application\Servers\UpdateServerStartupRequest;

class StartupController extends ApplicationApiController
{
    /**
     * StartupController constructor.
     */
    public function __construct(private StartupModificationService $modificationService)
    {
        parent::__construct();
    }

    /**
     * Update the startup and environment settings for a specific server.
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Shadowdactyl\Exceptions\Http\Connection\DaemonConnectionException
     * @throws \Shadowdactyl\Exceptions\Model\DataValidationException
     * @throws \Shadowdactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function index(UpdateServerStartupRequest $request, Server $server): array
    {
        $server = $this->modificationService
            ->setUserLevel(User::USER_LEVEL_ADMIN)
            ->handle($server, $request->validated());

        return $this->fractal->item($server)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }
}
