<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


require_once __DIR__ . '/../Document.php';


$doc = new \JDWX\HTML5\Document;
$doc
	->setTitle( "Example Title" ) 
	->addCSSFile( "test.css" )
	->body()
		->setClass( "foo" );
$el = $doc->createElement( "p" )
	->appendChild( "This is a test.", $doc->createElement( "br" ) )
	->setID( 'exampleID' );
$doc->appendToBody( $el );

echo $doc->tidy(), "\n";


