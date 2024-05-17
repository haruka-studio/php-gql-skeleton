<?php

namespace Vertuoza\Libs\Exceptions\Validators;

use Vertuoza\Libs\Exceptions\FieldError;

class StringValidator extends Validator
{
  /**
   * StringValidator constructor.
   *
   * @param string $field
   * @param string $value
   * @param string|null $path
   */
  public function __construct(string $field, string $value, ?string $path = "")
  {
    parent::__construct($field, $value, $path);
  }

  /**
   * Check if value is not empty.
   *
   * @param boolean $trimmed
   *
   * @return self
   */
  public function notEmpty(bool $trimmed = false): self
  {
    $value = $trimmed ? trim($this->value) : $this->value;
    if (empty($value)) {
      $this->errors[] = new FieldError($this->field, "Field cannot be empty", "EMPTY", $this->path);
    }

    return $this;
  }

  /**
   * Check that value contains the maximum character set.
   *
   * @param integer $max
   * @return self
   */
  public function max(int $max): self
  {
    if (isset($this->value) && strlen($this->value) > $max) {
      $this->errors[] = new FieldError($this->field, "Field cannot be longer than $max characters", "MAX_LENGTH", $this->path, ["max" => $max]);
    }

    return $this;
  }

  /**
   * Check that value contains the minimum character set.
   *
   * @param integer $min
   *
   * @return self
   */
  public function min(int $min): self
  {
    if (isset($this->value) && strlen($this->value) > $min) {
      $this->errors[] = new FieldError($this->field, "Field cannot be less than $min characters", "MIN_LENGTH", $this->path, ["min" => $min]);
    }

    return $this;
  }

  /**
   * Check if value complies with the allowed format.
   *
   * @param string $format
   *
   * @return self
   */
  public function format(string $format, string $allowedFormat = ''): self
  {
    if (isset($this->value) && empty(preg_match($format, $this->value))) {
      $this->errors[] = new FieldError($this->field, "Field does not comply with the allowed format (allowed: $allowedFormat)", "FORMAT", $this->path, ["allowed" => $allowedFormat]);
    }

    return $this;
  }
}
