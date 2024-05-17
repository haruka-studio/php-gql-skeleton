<?php

namespace Vertuoza\Usecases\Settings\Collaborators;

use React\Promise\Promise;
use Vertuoza\Api\Graphql\Context\UserRequestContext;
use Vertuoza\Repositories\Settings\Collaborators\CollaboratorRepository;
use Vertuoza\Entities\Settings\CollaboratorEntity;
use Vertuoza\Repositories\RepositoriesFactory;

class CollaboratorsFindManyUseCase
{
  private UserRequestContext $userContext;
  private CollaboratorRepository $collaboratorRepository;

  /**
   * CollaboratorsFindManyUseCase constructor
   *
   * @param RepositoriesFactory $repositories
   * @param UserRequestContext $userContext
   */
  public function __construct(
    RepositoriesFactory $repositories,
    UserRequestContext $userContext,
  ) {
    $this->collaboratorRepository = $repositories->collaborator;
    $this->userContext = $userContext;
  }

  /**
   * Handle request
   *
   * @param string $id id of the unit type to retrieve
   *
   * @return Promise<CollaboratorEntity>
   */
  public function handle()
  {
    return $this->collaboratorRepository->findMany($this->userContext->getTenantId());
  }
}
