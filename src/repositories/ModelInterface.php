<?php

namespace Vertuoza\Repositories;

use stdClass;

interface ModelInterface
{
  /**
  * Transform an anonymous class into model
  *
  * @param stdClass $data
  *
  * @return mixed
  */
  public static function fromStdclass(stdClass $data): mixed;

  /**
   * Returns the ID column name
   *
   * @return string
   */
  public static function getPkColumnName(): string;

  /**
   * Returns the tenant ID column name
   *
   * @return string
   */
  public static function getTenantColumnName(): string;

  /**
   * Returns the table name
   *
   * @return string
   */
  public static function getTableName(): string;
}
