<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


require_once __DIR__ . '/../Element.php';
require_once __DIR__ . '/Mockument.php';

$doc = new Mockument;
$el = new \JDWX\HTML5\Element( $doc, 'example' );
$el->setAttribute( 'foo', 'bar', 'baz' );
$el->setClass( 'qux', 'quux' );

$str = strval( $el );

echo $str, "\n";

