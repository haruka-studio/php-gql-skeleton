<?php

namespace Vertuoza\Repositories\Settings\Collaborators\Models;

use DateTime;
use stdClass;
use Vertuoza\Repositories\ModelInterface;

class CollaboratorModel implements ModelInterface
{
  public string $id;
  public string $name;
  public string $firstName;
  public ?DateTime $deleted_at;
  public ?string $tenant_id;

  /**
   * Transform an anonymous class into CollaboratorModel
   *
   * @param stdClass $data
   *
   * @return CollaboratorModel
   */
  public static function fromStdclass(stdClass $data): CollaboratorModel
  {
    $model = new CollaboratorModel();
    $model->id = (string) $data->id;
    $model->name = (string) $data->name;
    $model->firstName = (string) $data->first_name;
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
