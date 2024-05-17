<?php

namespace Vertuoza\Repositories;

use Overblog\DataLoader\DataLoader;
use Overblog\PromiseAdapter\PromiseAdapterInterface;
use React\Promise\Promise;
use Vertuoza\Repositories\Database\QueryBuilder;

abstract class AbstractRepository
{
  protected array $getbyIdsDL;
  protected $tableName;

  abstract protected function getDataloader(string $tenantId): DataLoader;

  /**
   * @param QueryBuilder $db
   * @param PromiseAdapterInterface $dataLoaderPromiseAdapter
   */
  public function __construct(
    protected QueryBuilder $db,
    protected PromiseAdapterInterface $dataLoaderPromiseAdapter
  ) {
    $this->getbyIdsDL = [];
  }

  /**
   * @param array $ids
   * @param string $tenantId
   *
   * @return Promise
   */
  public function getByIds(array $ids, string $tenantId): Promise
  {
    return $this->getDataloader($tenantId)->loadMany($ids);
  }

  /**
   * @param string $id
   * @param string $tenantId
   * @return Promise
   */
  public function getById(string $id, string $tenantId): Promise
  {
    return $this->getDataloader($tenantId)->load($id);
  }

  /**
   * Clear cache (refresh data)
   *
   * @param string $id
   *
   * @return void
   */
  protected function clearCache(string $id): void
  {
    foreach ($this->getbyIdsDL as $dl) {
      if ($dl->key_exists($id)) {
        $dl->clear($id);
        return;
      }
    }
  }
}
