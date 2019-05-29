<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


require_once __DIR__ . '/../Document.php';
require_once __DIR__ . '/../ElementFactory.php';


use \JDWX\HTML5\ElementFactory as ELF;


$doc = new \JDWX\HTML5\Document;

$el = ELF::a( $doc );
$el->setClass( "button" );
$el->setID( "test_a" );
$el->setHref( "/menu.html" );
$el->setTitle( "Menu" );
$el->setDownload( true );
$el->setPing( 'http://example.com/' );
$el->addRel( 'noreferrer', 'nofollow' );
$el->setTarget( '_self' );
$el->appendChild( "Menu" );
echo strval( $el ), "\n";

$el = ELF::br( $doc );
echo strval( $el ), "\n";

$el = ELF::p( $doc );
$el->appendChild( "Test" );
echo strval( $el ), "\n";



