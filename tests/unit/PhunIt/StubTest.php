<?php

namespace Tests\Unit\PhunIt;

use PhunIt\Stub;
use Assets\TestClass;
use Assets\TestException;

class StubTest extends \PHPUnit_Framework_TestCase {

  private $stub;

  public function setUp() {
    $this->stub = new Stub(new TestClass());
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
  public function callsHandledMethod() {
    $this->stub->handle('testMethod')->returnValue(4);
    $this->assertEquals(4, $this->stub->testMethod());
  }

  /**
   * @test
   */
  public function callsMoreThanOneMethod() {
    $this->stub->handle('testMethod')->returnValue(3);
    $this->stub->handle('anotherMethod')->returnValue(4);
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
    $this->stub->handle('testException')->returnException(new TestException("This is a test exception"));
    $this->stub->testException();
  }
  
  /**
   * @test
   */
  public function doesNotThrowExceptionsIfNotToldToDoSo() {
    $exception = new TestException("This exception shouldn't be thrown");
    $this->stub->handle('testMethod')->returnValue($exception);
    $this->assertEquals($exception, $this->stub->testMethod());
  }

  /**
   * @test
   */
  public function canWorkWithoutTargetObject() {
    $this->stub = new Stub();
    $this->stub->handle('testMethod')->returnValue(2);
    $this->assertEquals(2, $this->stub->testMethod());
  }

}