<?php

namespace PhunIt\Method;

use PhunIt\Stub\Stub;
use PhunIt\Value\StaticValue;
use PhunIt\Value\ExceptionValue;

class Method {

  private $stub;
  private $arguments;
  private $returnValue;

  public function __construct(Stub $stub) {
    $this->stub = $stub;
    $this->arguments = array();
  }

  public function with(array $arguments) {
    $this->arguments = $arguments;
    return $this;
  }

  public function returns($value) {
    $this->returnValue = new StaticValue($value);
    return $this->stub;
  }

  public function call() {
    return $this->returnValue->call();
  }

  public function returnsException(\Exception $exception) {
    $this->returnValue = new ExceptionValue($exception);
    return $this->stub;
  }

}