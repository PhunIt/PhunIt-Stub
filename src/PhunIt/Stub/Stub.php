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
  protected $stubbedMethods;

  public function __construct($target = null) {
    $this->target = $target;
    $this->stubbedMethods = array();
  }

  public function __call($method, $arguments) {
    if ($this->isMethodStubbed($method)) {
      return $this->callStubbedMethod($method);
    }
    return $this->callTargetMethod($method, $arguments);
  }

  public function stubs($method) {
    $this->stubbedMethods[$method] = new Method($this);
    return $this->stubbedMethods[$method];
  }

  protected function isMethodStubbed($method) {
    return array_key_exists($method, $this->stubbedMethods);
  }

  protected function callStubbedMethod($method) {
    return $this->stubbedMethods[$method]->call();
  }

  protected function callTargetMethod($method, $arguments) {
    try {
      return call_user_func_array(array($this->target, $method), $arguments);
    } catch (\Exception $e) {
      throw new \Exception("Method {$method} does not exist in target nor it's been handled by this stub");
    }
  }

}
