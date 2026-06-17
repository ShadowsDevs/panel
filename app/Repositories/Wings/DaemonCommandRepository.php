<?php

namespace Shadowdactyl\Repositories\Wings;

use Webmozart\Assert\Assert;
use Shadowdactyl\Models\Server;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\TransferException;
use Shadowdactyl\Exceptions\Http\Connection\DaemonConnectionException;

/**
 * @method \Shadowdactyl\Repositories\Wings\DaemonCommandRepository setNode(\Shadowdactyl\Models\Node $node)
 * @method \Shadowdactyl\Repositories\Wings\DaemonCommandRepository setServer(\Shadowdactyl\Models\Server $server)
 */
class DaemonCommandRepository extends DaemonRepository
{
    /**
     * Sends a command or multiple commands to a running server instance.
     *
     * @throws DaemonConnectionException
     */
    public function send(array|string $command): ResponseInterface
    {
        Assert::isInstanceOf($this->server, Server::class);

        try {
            return $this->getHttpClient()->post(
                sprintf('/api/servers/%s/commands', $this->server->uuid),
                [
                    'json' => ['commands' => is_array($command) ? $command : [$command]],
                ]
            );
        } catch (TransferException $exception) {
            throw new DaemonConnectionException($exception);
        }
    }
}
