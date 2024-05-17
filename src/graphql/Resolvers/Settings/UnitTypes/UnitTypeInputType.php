<?php

namespace Vertuoza\Api\Graphql\Resolvers\Settings\UnitTypes;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\NonNull;
use Vertuoza\Api\Graphql\Types;

class UnitTypeInputType extends InputObjectType
{
  public function __construct()
  {
    parent::__construct([
      'name' => 'UnitTypeCreateInput',
      'description' => 'Input type for UnitType',
      'fields' => static fn (): array => [
        'name' => [
          'description' => "Unit Type name (must be unique)",
          'type' => new NonNull(Types::string())
        ]
      ],
    ]);
  }
}
