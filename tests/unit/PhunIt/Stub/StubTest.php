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

use PhunIt\Stub\StubFactory;

use PhunIt\Stub\Stub;
use PhunIt\Method\Method;
use Assets\TestClass;
use Assets\AnotherTestClass;
use Assets\TestException;

class StubTest extends \PHPUnit_Framework_TestCase {

  public function testStubGeneration() {
    $testObject = new TestClass();
    $stub = Stub::create($testObject); 
    echo $stub->testMethod('a');
  }
  
//  private $testClass;
//
//  public function setUp() {
//    $this->testClass = new Stub(new TestClass());
//  }
//
//  /**
//   * @test
//   */
//  public function callsOriginalMethod() {
//    $this->assertEquals(5, $this->testClass->testMethod());
//  }
//
//  /**
//   * @test
//   */
//  public function returnsAMethodWhenStubbing() {
//    $this->assertTrue($this->testClass->stubs('foo') instanceof Method);
//  }
//
//  /**
//   * @test
//   */
//  public function callsHandledMethod() {
//    $this->testClass->stubs('testMethod')->returns(4);
//    $this->assertEquals(4, $this->testClass->testMethod());
//  }
//
//  /**
//   * @test
//   */
//  public function callsMoreThanOneMethod() {
//    $this->testClass->stubs('testMethod')->returns(3);
//    $this->testClass->stubs('anotherMethod')->returns(4);
//    $this->assertEquals(4, $this->testClass->anotherMethod());
//  }
//
//  /**
//   * @test
//   * @expectedException \Exception
//   */
//  public function throwsExceptionWhenMethodDoesNotExist() {
//    $this->testClass->notExistantMethod();
//  }
//
//  /**
//   * @test
//   * @expectedException Assets\TestException
//   */
//  public function canThrowExceptionsAsReturnValue() {
//    $this->testClass->stubs('testException')->returnsException(new TestException("This is a test exception"));
//    $this->testClass->testException();
//  }
//  
//  /**
//   * @test
//   */
//  public function doesNotThrowExceptionsIfNotToldToDoSo() {
//    $exception = new TestException("This exception shouldn't be thrown");
//    $this->testClass->stubs('testMethod')->returns($exception);
//    $this->assertEquals($exception, $this->testClass->testMethod());
//  }
//
//  /**
//   * @test
//   */
//  public function canWorkWithoutTargetObject() {
//    $ghostStub = new Stub();
//    $ghostStub->stubs('testMethod')->returns(2);
//    $this->assertEquals(2, $ghostStub->testMethod());
//  }
//
//  /**
//   * @t est
//   */
//  public function canDefineClosuresForCustomReturnValues() {
//    $squareRoot = function($number) {
//      return sqrt($number);
//    };
//    $this->testClass->stubs('testMethod')->with(array('number'))->returns($squareRoot);
//    $this->assertEquals(3, $this->testClass->testMethod(9));
//  }
//  
//  /**
//   * @test
//   */
//  public function stubInheritsFromTargetClass() {
//    $tc = new TestClass();
//    $atc = new AnotherTestClass();
//    runkit_class_adopt('Assets\TestClass', 'Assets\AnotherTestClass');
//    $tc = new TestClass();
//    try {
//      $this->objectFilter($tc);
//    } catch (Exception $e) {
//      echo $e->getMessage();
//    }
//    
//  }
//  
//  protected function objectFilter(AnotherTestClass $object) {
//    
//  }

}
