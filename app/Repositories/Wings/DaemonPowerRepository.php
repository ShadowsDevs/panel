<?php

namespace Shadowdactyl\Repositories\Wings;

use Webmozart\Assert\Assert;
use Shadowdactyl\Models\Server;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\TransferException;
use Shadowdactyl\Exceptions\Http\Connection\DaemonConnectionException;

/**
 * @method \Shadowdactyl\Repositories\Wings\DaemonPowerRepository setNode(\Shadowdactyl\Models\Node $node)
 * @method \Shadowdactyl\Repositories\Wings\DaemonPowerRepository setServer(\Shadowdactyl\Models\Server $server)
 */
class DaemonPowerRepository extends DaemonRepository
{
    /**
     * Sends a power action to the server instance.
     *
     * @throws DaemonConnectionException
     */
    public function send(string $action): ResponseInterface
    {
        Assert::isInstanceOf($this->server, Server::class);

        try {
            return $this->getHttpClient()->post(
                sprintf('/api/servers/%s/power', $this->server->uuid),
                ['json' => ['action' => $action]]
            );
        } catch (TransferException $exception) {
            throw new DaemonConnectionException($exception);
        }
    }
}
