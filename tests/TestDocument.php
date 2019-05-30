<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;


use \JDWX\HTML5\Elements;


class TestDocument extends Harness {


	function test() : void {

		$doc = new \JDWX\HTML5\Document;
		$doc->setTitle( "Example Title" );
		$doc->addCSSFile( "test.css" );
		$doc->body()->setClass( "foo" );

		$a = new Elements\A( $doc, "href", "title", "link" );
		$p = new Elements\P( $doc, "text" );
		$doc->appendToBody( "This is a test.", $a, $p );

		$strExpect = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Example Title</title><link href="test.css" rel="stylesheet" type="text/css"></head><body class="foo">This is a test.<a href="href" title="title">link</a><p>text</p></body></html>';

		$this->check( $strExpect, strval( $doc ) );

	}


}



