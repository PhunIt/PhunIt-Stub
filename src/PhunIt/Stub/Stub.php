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



class Stub {
  
  const STUB_CLASS_PREFIX = "Stub_";

  public static function create($target) {
    if (!is_object($target)) {
      throw new \Exception(__METHOD__.' requires a class instance to create a Stub');
    }
    $refObj = new \ReflectionObject($target);
    $stubClassName = self::getStubClassName($refObj);
    
    $classDef = sprintf(self::getStubbedClassTpl(), 
      self::getStubClassName($refObj), 
      self::getImplementsSection($refObj),
      self::getPublicMethods($refObj)
    );
    echo $classDef;
    eval($classDef);
    return new $stubClassName($target);
  }
  
  protected static function getStubbedClassTpl() {
    return <<<EOF
use PhunIt\Stub\Stubbed;
class %s extends Stubbed %s {
%s
}
EOF;
  }
  
  protected static function getStubbedMethodTpl() {
    return <<<EOF
	public%s function %s(%s) {
		%s__call('%s', array(%s));
	}
	
EOF;
  }
  
  protected static function getStubClassName(\ReflectionObject $refObj) {
    return sprintf("%s%s", self::STUB_CLASS_PREFIX, $refObj->getShortName());
  }
  
  protected static function getImplementsSection(\ReflectionObject $refObj) {
    return count($refObj->getInterfaceNames()) > 0 ? "implements ".implode(",", $refObj->getInterfaceNames()) : "";
  }
  
  protected static function getPublicMethods(\ReflectionObject $refObj) {
    $methods = "";
    foreach($refObj->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
      /* @var $method \ReflectionMethod */
      $methods .= sprintf(self::getStubbedMethodTpl(),
        $method->isStatic() ? " static" : "",
        $method->getName(),
        self::getStubbedMethodParameters($method),
        $method->isStatic() ? "self::" : "\$this->",
        $method->getName(),
        self::getStubbedMethodParameters($method)
      );
    }
    return $methods;
  }
  
  protected static function getStubbedMethodParameters(\ReflectionMethod $method) {
    $params = "";
    foreach($method->getParameters() as $param) {
      $params .= "\${$param->getName()}, ";
    }
    $params = substr($params, 0, -2);
    return $params;
  }
}
