<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;
require_once 'vendor/autoload.php';


use \JDWX\HTML5\Elements;


$doc = new \JDWX\HTML5\Document;

$el = new Elements\A( $doc );
$el->setClass( "button" );
$el->setID( "test_a" );
$el->setHref( "/menu.html" );
$el->setTitle( "Menu" );
$el->setDownload( true );
$el->setPing( 'http://example.com/' );
$el->addRel( 'noreferrer', 'nofollow' );
$el->setTarget( '_self' );
$el->appendChild( "Menu" );
$str = '<a class="button" download href="/menu.html" id="test_a" ping="http://example.com/" rel="noreferrer nofollow" target="_self" title="Menu">Menu</a>';
if ( $str == $el ) {
	echo "OK.\n";
} else {
	echo "Not OK.\n";
	echo $str, "\n", $el, "\n";
}


return;
$el = ELF::br( $doc );
echo strval( $el ), "\n";

$el = ELF::p( $doc );
$el->appendChild( "Test" );
echo strval( $el ), "\n";



