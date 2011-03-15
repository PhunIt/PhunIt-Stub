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

class Stub {

  protected $target;

  protected $returnValues = array();

  protected $currentMethod = null;

  public function __construct($target = null) {
    $this->target = $target;
  }

  public function __call($method, $arguments) {
    if (array_key_exists($method, $this->returnValues)) {
      if ($this->returnValues[$method] instanceof \Exception) {
        throw $this->returnValues[$method];
      }
      return $this->returnValues[$method];
    }
    try {
      return call_user_func_array(array($this->target, $method), $arguments);
    } catch (\Exception $e) {
      throw new \Exception("Method {$method} does not exist in target nor it's been handled by this stub");
    }
  }

  public function handle($method) {
    $this->returnValues[$method] = null;
    $this->currentMethod = $method;
    return $this;
  }

  public function returnValue($value) {
    $this->returnValues[$this->currentMethod] = $value;
    $this->currentMethod = null;
  }

  public function returnException(\Exception $exception) {
    $this->returnValues[$this->currentMethod] = $exception;
    $this->currentMethod = null;
  }

}
