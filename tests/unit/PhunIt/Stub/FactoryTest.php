<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Unit\PhunIt\Stub;

use PhunIt\Stub\Stub;
use PhunIt\Stub\Factory;
use Assets\TestInterface;
use Assets\TestClass;
use Assets\AnotherTestClass;

class FactoryTest extends \PHPUnit_Framework_TestCase {

  protected $class;

  protected $target;

  protected $stub;

  public function setUp() {
    $this->class = "TestClass";
    $this->target = new TestClass();
    $this->stub = Factory::create($this->target);
  }

  /**
   * @test
   * @expectedException \Exception
   */
  public function requiresAnObjectToStub() {
    Factory::create('chuchuBlabla');
  }

  /**
   * @test
   */
  public function stubbedObjectImplementsStubInterface() {
    $this->assertTrue($this->stub instanceof Stub);
  }

  /**
   * @test
   */
  public function stubbedObjectsClassContainsTheOriginalClass() {
    $this->assertContains($this->class, get_class($this->stub));
  }

  /**
   * @test
   */
  public function stubbedObjectsClassIsDifferentFromTheOriginalClass() {
    $this->assertNotEquals($this->class, get_class($this->stub));
  }

  /**
   * @test
   */
  public function stubbedObjectImplementsAllTheInterfacesFromTheOriginalClass() {
    $target = new AnotherTestClass();
    $stub = Factory::create($target);
    $this->assertTrue($target instanceof TestInterface);
  }

}
