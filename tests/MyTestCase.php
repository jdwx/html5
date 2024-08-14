<?php


declare( strict_types = 1 );


require __DIR__ . '/ElementHack.php';
require __DIR__ . '/MockDocument.php';


use PHPUnit\Framework\TestCase;


class MyTestCase extends TestCase {


    protected MockDocument $doc;


    protected function element( string $i_stTag ) : ElementHack {
        return new ElementHack( $this->doc, $i_stTag );
    }


    protected function setUp() : void {
        $this->doc = new MockDocument();
    }


}