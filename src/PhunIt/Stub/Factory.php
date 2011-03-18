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

class Factory {
  
  const STUB_CLASS_PREFIX = "Stub_";

  public static function create($target) {
    self::validateTarget($target);
    $object = new \ReflectionObject($target);
    $stubClassName = self::getStubClassName($object);
    if (!class_exists($stubClassName)) {
      self::createStubbedClass($object);
    }
    return new $stubClassName($target);
  }
  
  protected static function validateTarget($target) {
    if (!is_object($target)) {
      throw new \Exception(__METHOD__.' requires a class instance to create a Factory');
    }
  }
  
  protected static function getStubClassName(\ReflectionObject $object) {
    return sprintf("%s%s", self::STUB_CLASS_PREFIX, $object->getShortName());
  }
  
  protected static function createStubbedClass(\ReflectionObject $object) {
    $classDef = sprintf(self::getStubbedClassTpl(), 
      self::getStubClassName($object), 
      self::getImplementsSection($object),
      self::getPublicMethods($object)
    );
    eval($classDef);
  }
  
  protected static function getStubbedClassTpl() {
    return <<<EOF
    
use PhunIt\Stub\Stubbed;
class %s extends Stubbed %s {
  public function __construct(\$target) {
    \$this->stub_init(\$target);
  }
%s
}

EOF;
  }
  
  protected static function getImplementsSection(\ReflectionObject $object) {
    return count($object->getInterfaceNames()) > 0 ? "implements ".implode(",", $object->getInterfaceNames()) : "";
  }
  
  protected static function getPublicMethods(\ReflectionObject $object) {
    $methods = "";
    foreach($object->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
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
  
  protected static function getStubbedMethodTpl() {
    return <<<EOF
  public%s function %s(%s) {
    return %s__call('%s', array(%s));
  }
EOF;
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
