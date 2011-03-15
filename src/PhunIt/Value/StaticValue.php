<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhunIt\Value;

use PhunIt\Value\BaseValue as AbstractValue;

class StaticValue extends AbstractValue {

  public function call() {
    return $this->value;
  }

}

