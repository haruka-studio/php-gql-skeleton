<?php

namespace Vertuoza\Repositories;

use Overblog\PromiseAdapter\PromiseAdapterInterface;
use Vertuoza\Repositories\Database\QueryBuilder;
use Vertuoza\Repositories\Settings\UnitTypes\UnitTypeRepository;
use Vertuoza\Repositories\Settings\Collaborators\CollaboratorRepository;

class RepositoriesFactory
{
  public CollaboratorRepository $collaborator;
  public UnitTypeRepository $unitType;

  /**
   * RepositoriesFactory constructor
   *
   * @param QueryBuilder $database
   * @param PromiseAdapterInterface $dataLoaderPromiseAdapter
   */
  public function __construct(
    QueryBuilder $database,
    PromiseAdapterInterface $dataLoaderPromiseAdapter)
  {
    $this->unitType = new UnitTypeRepository($database, $dataLoaderPromiseAdapter);
    $this->collaborator = new CollaboratorRepository($database, $dataLoaderPromiseAdapter);
  }
}
