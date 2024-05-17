<?php

namespace Vertuoza\Repositories\Settings\Collaborators\Models;

use Vertuoza\Repositories\Settings\Collaborators\Models\CollaboratorModel;
use Vertuoza\Entities\Settings\CollaboratorEntity;
use Vertuoza\Repositories\Settings\Collaborators\CollaboratorMutationData;

class CollaboratorMapper
{
  /**
   * Transform CollaboratorModel into CollaboratorEntity
   *
   * @param CollaboratorModel $dbData
   *
   * @return CollaboratorEntity
   */
  public static function modelToEntity(CollaboratorModel $dbData): CollaboratorEntity
  {
    $entity = new CollaboratorEntity();
    $entity->id = (string) $dbData->id;
    $entity->name = (string) $dbData->name;
    $entity->firstName = (string) $dbData->firstName;

    return $entity;
  }

  /**
   * Serialize data for mutation (update)
   *
   * @param CollaboratorMutationData $mutation
   *
   * @return array
   */
  public static function serializeUpdate(CollaboratorMutationData $mutation): array
  {
    return self::serializeMutation($mutation);
  }

  /**
   * Serialize data for mutation (create)
   *
   * @param CollaboratorMutationData $mutation
   * @param string $tenantId
   *
   * @return array
   */
  public static function serializeCreate(CollaboratorMutationData $mutation, string $tenantId): array
  {
    return self::serializeMutation($mutation, $tenantId);
  }

  /**
   * Serialize data for mutation
   *
   * @param CollaboratorMutationData $mutation
   * @param string|null $tenantId
   *
   * @return array
   */
  private static function serializeMutation(CollaboratorMutationData $mutation, string $tenantId = null): array
  {
    $data = [
      'name' => $mutation->name,
      'firstName' => $mutation->firstName,
    ];

    if ($tenantId) {
      $data[CollaboratorModel::getTenantColumnName()] = $tenantId;
    }

    return $data;
  }
}
