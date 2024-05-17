<?php

namespace Vertuoza\Repositories\Settings\Collaborators;

use Overblog\DataLoader\DataLoader;
use React\Promise\PromiseInterface;
use Vertuoza\Repositories\AbstractRepository;
use Vertuoza\Repositories\Settings\Collaborators\Models\CollaboratorMapper;
use Vertuoza\Repositories\Settings\Collaborators\Models\CollaboratorModel;

use function React\Async\async;

class CollaboratorRepository extends AbstractRepository
{
  /**
   * Find all collaborators for current tenant ID
   *
   * @param string $tenantId
   */
  public function findMany(string $tenantId)
  {
    return async(
      fn () => $this->getQueryBuilder()
        ->whereNull('deleted_at')
        ->where(function ($query) use ($tenantId) {
          $query->where(CollaboratorModel::getTenantColumnName(), '=', $tenantId);
        })
        ->get()
        ->map(function ($row) {
          return CollaboratorMapper::modelToEntity(CollaboratorModel::fromStdclass($row));
        })
    )();
  }

  /**
   * Return the query builder for current table
   *
   * @return \Illuminate\Database\Query\Builder
   */
  protected function getQueryBuilder(): \Illuminate\Database\Query\Builder
  {
    return $this->db->getConnection()->table(CollaboratorModel::getTableName());
  }

  /**
   * Returns the data loader for collaborator
   *
   * @param string $tenantId
   *
   * @return DataLoader
   */
  protected function getDataloader(string $tenantId): DataLoader
  {
    if (!isset($this->getbyIdsDL[$tenantId])) {
      $dl = new DataLoader(function (array $ids) use ($tenantId) {
        return $this->fetchByIds($tenantId, $ids);
      }, $this->dataLoaderPromiseAdapter);
      $this->getbyIdsDL[$tenantId] = $dl;
    }

    return $this->getbyIdsDL[$tenantId];
  }

  /**
   * Fetch data by IDs
   *
   * @param string $tenantId
   * @param array $ids
   *
   * @return PromiseInterface
   */
  private function fetchByIds(string $tenantId, array $ids): PromiseInterface
  {
    return async(function () use ($tenantId, $ids) {
      $query = $this->getQueryBuilder()
        ->where(function ($query) use ($tenantId) {
          $query->where([CollaboratorModel::getTenantColumnName() => $tenantId]);
        });
      $query->whereNull('deleted_at');
      $query->whereIn(CollaboratorModel::getPkColumnName(), $ids);

      $entities = $query->get()->mapWithKeys(function ($row) {
        $entity = CollaboratorMapper::modelToEntity(CollaboratorModel::fromStdclass($row));
        return [$entity->id => $entity];
      });

      // Map the IDs to the corresponding entities, preserving the order of IDs.
      return collect($ids)
        ->map(fn ($id) => $entities->get($id))
        ->toArray();
    })();
  }
}
