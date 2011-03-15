<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhunIt\Method;

use PhunIt\Method\Method;

class Container {

  protected $methods = array();

  public function add($name, Method $method) {
    $this->methods[$name] = $method;
  }

  public function get($name) {
    return $this->methods[$name];
  }

  public function has($name) {
    return array_key_exists($name, $this->methods);
  }

}