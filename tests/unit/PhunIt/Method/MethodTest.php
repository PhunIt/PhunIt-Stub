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
use PhunIt\Method\Method;

class MethodTest extends \PHPUnit_Framework_TestCase {

  protected $method;
  protected $stub;

  public function setUp() {
    $this->stub = new Stub();
    $this->method = new Method($this->stub);
  }

  /**
   * @test
   */
  public function returnsItselfAfterSettingWith() {
    $this->assertEquals($this->method, $this->method->with(array('foo', 'bar')));
  }

  /**
   * @test
   */
  public function returnsTheStubAfterSettingReturns() {
    $this->assertEquals($this->stub, $this->method->returns(5));
  }

  /**
   * @test
   */
  public function returnsTheStubAfterSettingReturnsException() {
    $this->assertEquals($this->stub, $this->method->returnsException(new \Exception()));
  }

  /**
   * @test
   */
  public function performsCallOnValue() {
    $this->method->returns(5);
    $this->assertEquals(5, $this->method->call());
  }

}