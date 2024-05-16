<?php

namespace Vertuoza\Repositories\Settings\Collaborators\Models;

use DateTime;
use stdClass;

class CollaboratorModel
{
  public string $id;
  public string $name;
  public string $firstName;
  public ?DateTime $deleted_at;
  public ?string $tenant_id;
  public static function fromStdclass(stdClass $data): CollaboratorModel
  {
    $model = new CollaboratorModel();
    $model->id = $data->id;
    $model->name = $data->name;
    $model->firstName = $data->first_name;
    $model->deleted_at = $data->deleted_at;
    $model->tenant_id = $data->tenant_id;
    return $model;
  }

  /**
   * Returns the ID column name
   *
   * @return string
   */
  public static function getPkColumnName(): string
  {
    return 'id';
  }

  /**
   * Returns the tenant ID column name
   *
   * @return string
   */
  public static function getTenantColumnName(): string
  {
    return 'tenant_id';
  }

  /**
   * Returns the table name
   *
   * @return string
   */
  public static function getTableName(): string
  {
    return 'collaborator';
  }
}
