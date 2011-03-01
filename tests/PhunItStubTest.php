<?php

class PhunItStubTest extends PHPUnit_Framework_TestCase {

  private $stub;

  public function setUp() {
    $this->stub = new PhunItStub(new DemoClass());
  }

  /**
   * @test
   */
  public function invokeOriginalMethod() {
    $this->assertEquals(5, $this->stub->demo());
  }

  /**
   * @test
   */
  public function invokeOneMethodInStub() {
    $this->stub->method('demo')->returnValue(4);
    $this->assertEquals(4, $this->stub->demo());
  }

  /**
   * @test
   */
  public function invokeMoreMethodsInStub() {
    $this->stub->method('demo1')->returnValue(3);
    $this->stub->method('demo2')->returnValue(4);
    $this->assertEquals(3, $this->stub->demo1());
    $this->assertEquals(4, $this->stub->demo2());
  }

  /**
   * @test
   * @expectedException Exception
   */
  public function whenMethodNotExists() {
    $this->stub->oneMethod();
  }

  /**
   * @test
   * @expectedException TestException
   */
  public function whenMethodShouldThrowException() {
    $this->stub->method('demoException')->returnException(new TestException('This is a test exception'));
    $this->stub->demoException();
  }

}

class TestException extends Exception {

}

class DemoClass {

  public function demo() {
    return 5;
  }

}

?>
