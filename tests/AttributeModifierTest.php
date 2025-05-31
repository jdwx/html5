<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use JDWX\HTML5\AbstractModifier;
use JDWX\HTML5\AttributeModifier;
use JDWX\HTML5\Elements\Div;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( AbstractModifier::class )]
#[CoversClass( AttributeModifier::class )]
final class AttributeModifierTest extends TestCase {


    public function testContent() : void {
        $mod = new AttributeModifier( 'foo', 'bar', 'baz' );
        self::assertSame( 'baz', $mod->content() );
    }


    public function testModify() : void {
        $mod = new AttributeModifier( 'class', 'foo', 'baz' );
        $div = new Div();
        $mod->modify( $div );
        self::assertSame( 'foo', $div->getClass() );
    }


    public function testToString() : void {
        $mod = new AttributeModifier( 'class', 'foo', 'baz' );
        self::assertSame( 'baz', strval( $mod ) );
    }


}
