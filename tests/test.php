#!/usr/bin/env php
<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;
require_once 'vendor/autoload.php';
require_once __DIR__ . '/Collector.php';
require_once __DIR__ . '/Harness.php';
require_once __DIR__ . '/Mockument.php';
require_once __DIR__ . '/TestDocument.php';
require_once __DIR__ . '/TestElement.php';


$rTests = [
	'TestDocument',
	'TestElement',
];


$tst = new Collector();
foreach ( $rTests as $stTest ) {
	$stClass = "\\JDWX\\HTML5\\Tests\\{$stTest}";
	// require_once __DIR__ . '/' . $stTest . '.php';
	( new $stClass( $tst ) )->run();
}


