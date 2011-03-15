<?php

require_once __DIR__ . '/../src/PhunIt/UniversalClassLoader.php';

use PhunIt\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
	'PhunIt' => __DIR__ . '/../src',
    'Assets' => __DIR__ . '/../tests'
));
$loader->register();

use PhunIt\Stub;
$stub = new Stub();

?>
