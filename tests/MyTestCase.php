<?php


declare( strict_types = 1 );


require __DIR__ . '/ElementHack.php';
require __DIR__ . '/MockDocument.php';


use JDWX\HTML5\IElement;
use PHPUnit\Framework\TestCase;


class MyTestCase extends TestCase {


    protected MockDocument $doc;


    protected function checkElement( string $i_stExpect, IElement $i_elGot ) : void {
        $stGot = (string) $i_elGot;
        self::assertEquals( $i_stExpect, $stGot );
    }


    protected function element( string $i_stTag ) : ElementHack {
        return new ElementHack( $this->doc, $i_stTag );
    }


    protected function setUp() : void {
        $this->doc = new MockDocument();
    }


}