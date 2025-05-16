<?php


declare( strict_types = 1 );


require __DIR__ . '/MockDocument.php';


use JDWX\HTML5\Element;
use PHPUnit\Framework\TestCase;


class MyTestCase extends TestCase {


    protected MockDocument $doc;


    protected function element( string $i_stTag ) : Element {
        return new Element( $i_stTag );
    }


    protected function setUp() : void {
        $this->doc = new MockDocument();
    }


}