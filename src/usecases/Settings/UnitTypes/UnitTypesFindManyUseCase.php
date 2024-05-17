<?php

namespace Vertuoza\Usecases\Settings\UnitTypes;

use React\Promise\Promise;
use Vertuoza\Api\Graphql\Context\UserRequestContext;
use Vertuoza\Repositories\Settings\UnitTypes\UnitTypeRepository;
use Vertuoza\Entities\Settings\UnitTypeEntity;
use Vertuoza\Repositories\RepositoriesFactory;

class UnitTypesFindManyUseCase
{
  private UserRequestContext $userContext;
  private UnitTypeRepository $unitTypeRepository;

  /**
   * UnitTypesFindManyUseCase constructor
   *
   * @param RepositoriesFactory $repositories
   * @param UserRequestContext $userContext
   */
  public function __construct(
    RepositoriesFactory $repositories,
    UserRequestContext $userContext,
  ) {
    $this->unitTypeRepository = $repositories->unitType;
    $this->userContext = $userContext;
  }

  /**
   * Handle request
   *
   * @return Promise<UnitTypeEntity>
   */
  public function handle()
  {
    return $this->unitTypeRepository->findMany($this->userContext->getTenantId());
  }
}
