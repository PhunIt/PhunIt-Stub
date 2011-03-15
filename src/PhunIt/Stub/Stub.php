<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhunIt\Stub;

use PhunIt\Method\Method;
use PhunIt\Method\Container;

class Stub {

  protected $target;
  protected $methodContainer;

  public function __construct($target = null) {
    $this->target = $target;
    $this->methodContainer = new Container();
  }

  public function __call($method, $arguments) {
    if ($this->methodContainer->has($method)) {
      return $this->methodContainer->get($method)->call();
    }
    return $this->callTargetMethod($method, $arguments);
  }

  public function stubs($methodName) {
    $method = new Method($this);
    $this->methodContainer->add($methodName, $method);
    return $method;
  }

  protected function callTargetMethod($method, $arguments) {
    try {
      return call_user_func_array(array($this->target, $method), $arguments);
    } catch (\Exception $e) {
      throw new \Exception("Method {$method} does not exist in target nor it's been handled by this stub");
    }
  }

}
