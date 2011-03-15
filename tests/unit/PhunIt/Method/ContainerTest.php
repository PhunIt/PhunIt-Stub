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

use PhunIt\Stub\Stub;
use PhunIt\Method\Container;
use PhunIt\Method\Method;

class ContainerTest extends \PHPUnit_Framework_TestCase {

  protected $container;
  protected $method;

  public function setUp() {
    $this->container = new Container();
    $this->method = new Method(new Stub());
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

}