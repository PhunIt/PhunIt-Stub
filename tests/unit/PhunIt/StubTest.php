<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Unit\PhunIt;

use PhunIt\Stub;
use Assets\TestClass;
use Assets\TestException;

class StubTest extends \PHPUnit_Framework_TestCase {

  private $testClass;

  public function setUp() {
    $this->testClass = new Stub(new TestClass());
  }

  /**
   * @test
   */
  public function callsOriginalMethod() {
    $this->assertEquals(5, $this->testClass->testMethod());
  }

  /**
   * @test
   */
  public function callsHandledMethod() {
    $this->testClass->stubs('testMethod')->returns(4);
    $this->assertEquals(4, $this->testClass->testMethod());
  }

  /**
   * @test
   */
  public function callsMoreThanOneMethod() {
    $this->testClass->stubs('testMethod')->returns(3);
    $this->testClass->stubs('anotherMethod')->returns(4);
    $this->assertEquals(4, $this->testClass->anotherMethod());
  }

  /**
   * @test
   * @expectedException \Exception
   */
  public function throwsExceptionWhenMethodDoesNotExist() {
    $this->testClass->notExistantMethod();
  }

  /**
   * @test
   * @expectedException Assets\TestException
   */
  public function canThrowExceptionsAsReturnValue() {
    $this->testClass->stubs('testException')->returnsException(new TestException("This is a test exception"));
    $this->testClass->testException();
  }
  
  /**
   * @test
   */
  public function doesNotThrowExceptionsIfNotToldToDoSo() {
    $exception = new TestException("This exception shouldn't be thrown");
    $this->testClass->stubs('testMethod')->returns($exception);
    $this->assertEquals($exception, $this->testClass->testMethod());
  }

  /**
   * @test
   */
  public function canWorkWithoutTargetObject() {
    $ghostStub = new Stub();
    $ghostStub->stubs('testMethod')->returns(2);
    $this->assertEquals(2, $ghostStub->testMethod());
  }

  /**
   *
   * @test
   */
  public function canDefineClosuresForCustomReturnValues() {
    $squareRoot = function($number) {
      return sqrt($number);
    };
    $this->testClass->stubs('testMethod')->with(array('number'))->returns($squareRoot);
    $this->assertEquals(3, $this->testClass->testMethod(9));
  }

}