<?php

namespace Vertuoza\Usecases\Settings\UnitTypes;

use React\Promise\Promise;
use Vertuoza\Api\Graphql\Context\UserRequestContext;
use Vertuoza\Entities\Settings\UnitTypeEntity;
use Vertuoza\Repositories\RepositoriesFactory;
use Vertuoza\Repositories\Settings\UnitTypes\UnitTypeMutationData;
use Vertuoza\Repositories\Settings\UnitTypes\UnitTypeRepository;

class UnitTypeCreateUseCase
{
  private UnitTypeRepository $unitTypeRepository;
  private UserRequestContext $userContext;

  public function __construct(
    RepositoriesFactory $repositories,
    UserRequestContext $userContext
  ) {
    $this->unitTypeRepository = $repositories->unitType;
    $this->userContext = $userContext;
  }

  /**
   * @param string $name id of the unit type to retrieve
   * @return Promise<UnitTypeEntity>
   */
  public function handle(string $name): Promise
  {
    if (empty(preg_match('/^[0-9a-z \-]+$/i', $name))) {
      throw new \Exception('Name should contain only alphabet and spaces, and not nullable');
    }

    $mutationData = new UnitTypeMutationData();
    $mutationData->name = $name;
    $newId = $this->unitTypeRepository->create($mutationData, $this->userContext->getTenantId());

    return $this->unitTypeRepository->getById((string) $newId, $this->userContext->getTenantId());
  }
}
