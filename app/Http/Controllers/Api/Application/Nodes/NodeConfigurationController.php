<?php

namespace Shadowdactyl\Http\Controllers\Api\Application\Nodes;

use Shadowdactyl\Models\Node;
use Illuminate\Http\JsonResponse;
use Shadowdactyl\Http\Controllers\Api\Application\ApplicationApiController;
use Shadowdactyl\Http\Requests\Api\Application\Nodes\GetNodeConfigurationRequest;

class NodeConfigurationController extends ApplicationApiController
{
    /**
     * Returns the configuration information for a node. This allows for automated deployments
     * to remote machines so long as an API key is provided to the machine to make the request
     * with, and the node is known.
     */
    public function __invoke(GetNodeConfigurationRequest $request, Node $node): JsonResponse
    {
        return new JsonResponse($node->getConfiguration());
    }
}
