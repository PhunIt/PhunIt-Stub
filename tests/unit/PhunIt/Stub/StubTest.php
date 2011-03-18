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

use PhunIt\Stub\Factory;
use PhunIt\Method\Method;
use Assets\TestClass;
use Assets\TestException;

class StubTest extends \PHPUnit_Framework_TestCase {

  protected $target;

  protected $stub;

  public function setUp() {
    $this->target = new TestClass();
    $this->stub = Factory::create($this->target);
  }

  /**
   * @test
   */
  public function callsOriginalMethod() {
    $this->assertEquals(5, $this->stub->testMethod());
  }

  /**
   * @test
   */
  public function returnsAMethodWhenStubbing() {
    $this->assertTrue($this->stub->stubs('foo') instanceof Method);
  }

  /**
   * @test
   */
  public function callsHandledMethod() {
    $this->stub->stubs('testMethod')->returns(4);
    $this->assertEquals(4, $this->stub->testMethod());
  }

  /**
   * @test
   */
  public function callsMoreThanOneMethod() {
    $this->stub->stubs('testMethod')->returns(3);
    $this->stub->stubs('anotherMethod')->returns(4);
    $this->assertEquals(4, $this->stub->anotherMethod());
  }

  /**
   * @test
   * @expectedException \Exception
   */
  public function throwsExceptionWhenMethodDoesNotExist() {
    $this->stub->notExistantMethod();
  }

  /**
   * @test
   * @expectedException Assets\TestException
   */
  public function canThrowExceptionsAsReturnValue() {
    $this->stub->stubs('testException')->returnsException(new TestException("This is a test exception"));
    $this->stub->testException();
  }

  /**
   * @test
   */
  public function doesNotThrowExceptionsIfNotToldToDoSo() {
    $exception = new TestException("This exception shouldn't be thrown");
    $this->stub->stubs('testMethod')->returns($exception);
    $this->assertEquals($exception, $this->stub->testMethod());
  }

  /**
   * @test
   */
  public function canDefineClosuresForCustomReturnValues() {
    $squareRoot = function ($number) {
      return sqrt($number);
    };
    $this->stub->stubs('testMethod')->with(array('number'))->returns($squareRoot);
    $this->assertEquals(3, $this->stub->testMethod(9));
  }

}
