<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Assets;

use Assets\TestInterface;

class TestClass implements TestInterface {

  public $testField = 5;

  public function testMethod($a = 'foo') {
    return $this->testField;
  }

}