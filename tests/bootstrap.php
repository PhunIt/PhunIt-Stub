<?php

/*
 * This file is part of the PhunIt package.
 *
 * (c) PhunIt (https://github.com/PhunIt)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/../src/PhunIt/ClassLoader/UniversalClassLoader.php';

use PhunIt\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'PhunIt' => __DIR__ . '/../src',
    'Assets' => __DIR__ . '/../tests'
));
$loader->register();