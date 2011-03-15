<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhunIt\Value;

use PhunIt\Value\Value;
use PhunIt\Value\StaticValue;
use PhunIt\Value\ExceptionValue;

class Container {

  protected $values = array();

  /**
   * @param string $method name
   * @param PhunIt\Value\Value $value
   */
  public function add($method, Value $value) {
    $this->values[$method] = $value;
  }

  /**
   * @param string $method name
   * @return PhunIt\Value\Value
   */
  public function getValue($method) {
    return $this->values[$method];
  }

  /**
   * @param string $method name
   * @return boolean
   */
  public function hasValueFor($method) {
    return array_key_exists($method, $this->values);
  }

}