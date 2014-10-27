<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/ClassLoader/SplClassLoader.php";

$classLoader = new SplClassLoader('Elements', $_SERVER['DOCUMENT_ROOT']);
$classLoader->register();

$firstList = new Elements\ul('My first list object');
echo $content1 = $firstList->render();

use Elements as e;
$secondList = new e\ul('My second list object');
echo $content2 = $secondList->render();

?>
