<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests\Shims;


use JDWX\HTML5\Element;
use PHPUnit\Framework\TestCase;


class MyTestCase extends TestCase {


    protected function element( string $i_stTag ) : Element {
        return new Element( $i_stTag );
    }


    protected function setUp() : void {}


}