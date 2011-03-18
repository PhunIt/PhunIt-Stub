<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Unit\PhunIt\Method;

use PhunIt\Stub\Factory;
use PhunIt\Method\Container;
use PhunIt\Method\Method;
use Assets\TestClass;

class ContainerTest extends \PHPUnit_Framework_TestCase {

  protected $target;
  protected $stub;
  protected $method;
  protected $container;

  public function setUp() {
    $this->target = new TestClass();
    $this->stub = Factory::create($this->target);
    $this->method = new Method($this->stub);
    $this->container = new Container();
  }

  /**
   * @test
   */
  public function canAddMethods() {
    $this->assertEquals($this->method, $this->container->add('testMethod', $this->method));
  }

  /**
   * @test
   */
  public function canGetMethods() {
    $this->container->add('testMethod', $this->method);
    $this->assertEquals($this->method, $this->container->get('testMethod'));
  }

  /**
   * @test
   */
  public function canCheckIfMethodExists() {
    $this->container->add('testMethod', $this->method);
    $this->assertTrue($this->container->has('testMethod'));
  }

  /**
   * @test
   */
  public function canCheckIfMethodDoesNotExist() {
    $this->assertFalse($this->container->has('anotherMethod'));
  }

  /**
   * @test
   * @expectedException \Exception
   */
  public function throwsExceptionWhenGettingAMethodThatDoesNotExist() {
    $this->container->get('foo');
  }


}