<?php


declare( strict_types = 1 );


use JDWX\HTML5\DummyDocument;
use PHPUnit\Framework\TestCase;


class DummyDocumentTest extends TestCase {


    public function testAppendChild() : void {
        $doc = new DummyDocument();
        $doc->appendChild( 'foo', 'bar' );
        self::expectNotToPerformAssertions();
    }


}
