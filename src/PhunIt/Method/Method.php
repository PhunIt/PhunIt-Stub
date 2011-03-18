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

use PhunIt\Stub\Stub;
use PhunIt\Value\StaticValue;
use PhunIt\Value\ExceptionValue;

class Method {

  private $stub;
//  private $arguments;
  private $returnValue;

  public function __construct(Stub $stub) {
    $this->stub = $stub;
    $this->arguments = array();
  }

//  public function with(array $arguments) {
//    $this->arguments = $arguments;
//    return $this;
//  }

  public function returns($value) {
    $this->returnValue = new StaticValue($value);
    return $this->stub;
  }

  public function returnsException(\Exception $exception) {
    $this->returnValue = new ExceptionValue($exception);
    return $this->stub;
  }

  public function call() {
    return $this->returnValue->call();
  }

}