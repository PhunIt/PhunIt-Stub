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

use PhunIt\Stub\Stub;
use PhunIt\Method\Method;
use PhunIt\Method\Container;

abstract class Stubbed implements Stub {

  protected $stub_target;
  protected $stub_methodContainer;

  public function stub_init($target) {
    $this->stub_target = $target;
    $this->stub_methodContainer = new Container();
  }
  
  public function __call($method, $arguments) {
    if ($this->stub_methodContainer->has($method)) {
      return $this->stub_methodContainer->get($method)->call();
    }
    return $this->callTargetMethod($method, $arguments);
  }

  /**
   * Creates a new stubbed method
   * 
   * @param string $methodName
   */
  public function stubs($methodName) {
    $method = new Method($this);
    $this->stub_methodContainer->add($methodName, $method);
    return $method;
  }

  protected function callTargetMethod($method, $arguments) {
    try {
      return call_user_func_array(array($this->stub_target, $method), $arguments);
    } catch (\Exception $e) {
      throw new \Exception("Method {$method} does not exist in target nor it's been handled by this stub");
    }
  }
}