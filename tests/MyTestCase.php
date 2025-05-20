<?php


declare( strict_types = 1 );


use JDWX\HTML5\HtmlElement;
use PHPUnit\Framework\TestCase;


class MyTestCase extends TestCase {


    protected function element( string $i_stTag ) : HtmlElement {
        return new HtmlElement( $i_stTag );
    }


    protected function setUp() : void {}


}