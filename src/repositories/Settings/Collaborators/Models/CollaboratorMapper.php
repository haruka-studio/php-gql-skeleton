<?php

namespace Vertuoza\Repositories\Settings\Collaborators\Models;

use stdClass;
use Vertuoza\Repositories\Settings\Collaborators\Models\CollaboratorModel;
use Vertuoza\Entities\Settings\CollaboratorEntity;

class CollaboratorMapper
{
  public static function modelToEntity(CollaboratorModel $dbData): CollaboratorEntity
  {
    $entity = new CollaboratorEntity();
    $entity->id = $dbData->id . '';
    $entity->name = $dbData->name;
    $entity->firstName = $dbData->firstName;

    return $entity;
  }
}
