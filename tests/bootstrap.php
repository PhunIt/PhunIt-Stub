<?php

require_once __DIR__ . '/../src/PhunIt/ClassLoader/UniversalClassLoader.php';

use PhunIt\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
	'PhunIt' => __DIR__ . '/../src',
	'Assets' => __DIR__ . '/../tests'
));
$loader->register();

?>
