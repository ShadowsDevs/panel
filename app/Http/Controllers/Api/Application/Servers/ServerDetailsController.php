<?php

namespace Shadowdactyl\Http\Controllers\Api\Application\Servers;

use Shadowdactyl\Models\Server;
use Shadowdactyl\Services\Servers\BuildModificationService;
use Shadowdactyl\Services\Servers\DetailsModificationService;
use Shadowdactyl\Transformers\Api\Application\ServerTransformer;
use Shadowdactyl\Http\Controllers\Api\Application\ApplicationApiController;
use Shadowdactyl\Http\Requests\Api\Application\Servers\UpdateServerDetailsRequest;
use Shadowdactyl\Http\Requests\Api\Application\Servers\UpdateServerBuildConfigurationRequest;

class ServerDetailsController extends ApplicationApiController
{
    /**
     * ServerDetailsController constructor.
     */
    public function __construct(
        private BuildModificationService $buildModificationService,
        private DetailsModificationService $detailsModificationService,
    ) {
        parent::__construct();
    }

    /**
     * Update the details for a specific server.
     *
     * @throws \Shadowdactyl\Exceptions\DisplayException
     * @throws \Shadowdactyl\Exceptions\Model\DataValidationException
     * @throws \Shadowdactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function details(UpdateServerDetailsRequest $request, Server $server): array
    {
        $updated = $this->detailsModificationService->returnUpdatedModel()->handle(
            $server,
            $request->validated()
        );

        return $this->fractal->item($updated)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }

    /**
     * Update the build details for a specific server.
     *
     * @throws \Shadowdactyl\Exceptions\DisplayException
     * @throws \Shadowdactyl\Exceptions\Model\DataValidationException
     * @throws \Shadowdactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function build(UpdateServerBuildConfigurationRequest $request, Server $server): array
    {
        $server = $this->buildModificationService->handle($server, $request->validated());

        return $this->fractal->item($server)
            ->transformWith($this->getTransformer(ServerTransformer::class))
            ->toArray();
    }
}
