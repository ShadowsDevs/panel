<?php

namespace Shadowdactyl\Services\Eggs;

use Ramsey\Uuid\Uuid;
use Shadowdactyl\Models\Egg;
use Shadowdactyl\Contracts\Repository\EggRepositoryInterface;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Shadowdactyl\Exceptions\Service\Egg\NoParentConfigurationFoundException;

// When a mommy and a daddy shadowdactyl really like each other...
class EggCreationService
{
    /**
     * EggCreationService constructor.
     */
    public function __construct(private ConfigRepository $config, private EggRepositoryInterface $repository)
    {
    }

    /**
     * Create a new service option and assign it to the given service.
     *
     * @throws \Shadowdactyl\Exceptions\Model\DataValidationException
     * @throws NoParentConfigurationFoundException
     */
    public function handle(array $data): Egg
    {
        $data['config_from'] = array_get($data, 'config_from');
        if (!is_null($data['config_from'])) {
            $results = $this->repository->findCountWhere([
                ['nest_id', '=', array_get($data, 'nest_id')],
                ['id', '=', array_get($data, 'config_from')],
            ]);

            if ($results !== 1) {
                throw new NoParentConfigurationFoundException(trans('exceptions.nest.egg.must_be_child'));
            }
        }

        return $this->repository->create(array_merge($data, [
            'uuid' => Uuid::uuid4()->toString(),
            'author' => $this->config->get('shadowdactyl.service.author'),
        ]), true, true);
    }
}
