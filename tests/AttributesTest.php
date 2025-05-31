<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use JDWX\HTML5\Attributes\StyleTrait;
use JDWX\HTML5\Elements\Div;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( StyleTrait::class )]
final class AttributesTest extends TestCase {


    public function testStyle() : void {
        $div = new Div();
        $div->style( 'color: red', 'background: blue', 'display: none' );
        self::assertSame( 'color: red; background: blue; display: none;', $div->getStyle() );
    }


}
