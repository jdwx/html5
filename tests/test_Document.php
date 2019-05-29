<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


require_once __DIR__ . '/../Document.php';
require_once __DIR__ . '/../ElementFactory.php';


use \JDWX\HTML5\ElementFactory as EFT;


$doc = new \JDWX\HTML5\Document;
$doc
	->setTitle( "Example Title" ) 
	->addCSSFile( "test.css" )
	->body()
		->setClass( "foo" );
$a = EFT::a( $doc );
$a->appendChild( "link" );
$p = EFT::p( $doc );
$p->appendChild( "text" );
$doc->appendToBody( "This is a test.", $a, $p );
echo $doc->tidy(), "\n";
$strExpect = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Example Title</title><link href="test.css" rel="stylesheet" type="text/css"></head><body class="foo">This is a test.<a>link</a><p>text</p></body></html>';
if ( $doc == $strExpect ) {
	echo "OK.\n";
} else {
	echo "Not OK.\n";
}



