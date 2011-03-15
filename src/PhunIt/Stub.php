<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhunIt;

use PhunIt\Value\Container;
use PhunIt\Value\Value;
use PhunIt\Value\StaticValue;
use PhunIt\Value\ExceptionValue;

class Stub {

  protected $target;
  protected $valueContainer;
  protected $currentMethod = null;

  public function __construct($target = null) {
    $this->target = $target;
    $this->valueContainer = new Container();
  }

  public function __call($method, $arguments) {
    if ($this->isMethodStubbed($method)) {
      return $this->callStubbedMethod($method);
    }
    return $this->callTargetMethod($method, $arguments);
  }

  public function stubs($method) {
    return $this->setCurrentMethod($method);
  }

  public function returns($value) {
    return $this->addStubbedMethod(new StaticValue($value));
  }

  public function returnsException(\Exception $exception) {
    return $this->addStubbedMethod(new ExceptionValue($exception));
  }

  protected function isMethodStubbed($method) {
    return $this->valueContainer->hasValueFor($method);
  }

  protected function callStubbedMethod($method) {
    return $this->valueContainer->getValue($method)->call();
  }

  protected function callTargetMethod($method, $arguments) {
    try {
      return call_user_func_array(array($this->target, $method), $arguments);
    } catch (\Exception $e) {
      throw new \Exception("Method {$method} does not exist in target nor it's been handled by this stub");
    }
  }

  protected function setCurrentMethod($method) {
    $this->currentMethod = $method;
    return $this;
  }

  protected function addStubbedMethod(Value $value) {
    $this->valueContainer->add($this->currentMethod, $value);
    $this->resetCurrentMethod();
    return $this;
  }
  
  protected function resetCurrentMethod() {
    $this->currentMethod = null;
    return null;
  }

  

}
