<?php

namespace Vertuoza\Libs\Exceptions;

use Throwable;

class BadInputException extends BusinessException
{
  public const code = 400;

  /**
   * @param string $message
   * @param string $errorCode
   * @param Throwable|null $previous
   * @param array|null|null $args
   */
  public function __construct(
    string $message,
    string $errorCode = "BAD_INPUT",
    Throwable $previous = null,
    array|null $args = null
  ) {
    parent::__construct($message, $errorCode, self::code, $previous, $args);
  }
}
