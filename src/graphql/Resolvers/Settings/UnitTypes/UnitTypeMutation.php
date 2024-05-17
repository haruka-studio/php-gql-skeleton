<?php

namespace Vertuoza\Api\Graphql\Resolvers\Settings\UnitTypes;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Vertuoza\Api\Graphql\Context\RequestContext;
use Vertuoza\Api\Graphql\Types;

class UnitTypeMutation extends ObjectType
{
  static function get()
  {
    return [
      'createUnitType' => [
        'type' => Types::get(UnitType::class),
        'args' => [
          'input' => Type::nonNull(Types::get(UnitTypeInputType::class)),
        ],
        'resolve' => static fn ($rootValue, $args, RequestContext $context)
        => $context->useCases->unitType
          ->unitTypeCreateUseCase
          ->handle($args['input']['name'], $context)
      ]
    ];
  }
}
