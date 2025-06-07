<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use JDWX\HTML5\AttributeModifier;
use JDWX\HTML5\Element;
use JDWX\HTML5\ElementList;
use JDWX\HTML5\Elements\Div;
use JDWX\HTML5\ModifierInterface;
use JDWX\Stream\SimpleStringable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Stringable;


#[CoversClass( ElementList::class )]
final class ElementListTest extends TestCase {


    public function testAppendForModifier() : void {
        $mod = new AttributeModifier( 'class', 'foo', 'Foo' );
        $list = new class() extends ElementList {


            public mixed $xMod = null;


            protected function handleModifier( ModifierInterface $i_modifier ) : void {
                $this->xMod = $i_modifier;
            }


        };
        $list->append( $mod );
        self::assertSame( 1, $list->countChildren() );
        self::assertSame( $mod, $list->xMod );
        self::assertSame( [ 'Foo' ], $list->asList() );
    }


    public function testAppendingToElement() : void {
        $baz = new SimpleStringable( 'Baz' );
        $qux = new Div( 'Qux' );
        $list = new ElementList( [ 'Foo', 'Bar', $baz, $qux ] );

        self::assertCount( 4, $list->asList() );

        $el = new Div( 'Quux' );
        self::assertSame( 1, $el->countChildren() );
        $el->append( $list );
        self::assertSame( 5, $el->countChildren() );

    }


    public function testHandleModifierForNoHandler() : void {
        $mod = new AttributeModifier( 'class', 'foo', 'Foo' );
        $list = new ElementList();
        $list->append( $mod );
        self::assertSame( [ 'Foo' ], $list->asList() );
    }


    public function testNthChildElement() : void {
        $elChild1 = new Element( i_children: 'foo' );
        $elChild2 = new Element( i_children: 'bar' );
        $list = new ElementList( [ 'baz', $elChild1, 'qux', $elChild2, 'corge' ] );
        self::assertSame( 5, $list->countChildren() );
        self::assertSame( $elChild1, $list->nthChildElement( 0 ) );
        self::assertSame( $elChild2, $list->nthChildElement( 1 ) );
        self::assertNull( $list->nthChildElement( 2 ) );
    }


    public function testPrependChildForModifier() : void {
        $mod = new AttributeModifier( 'class', 'foo', 'Foo' );
        $list = new class() extends ElementList {


            public mixed $xMod = null;


            protected function handleModifier( ModifierInterface $i_modifier ) : void {
                $this->xMod = $i_modifier;
            }


        };
        $list->prependChild( $mod );
        self::assertSame( 1, $list->countChildren() );
        self::assertSame( $mod, $list->xMod );
        self::assertSame( [ 'Foo' ], $list->asList() );
    }


    public function testToString() : void {
        $list = new ElementList( [ 'Foo', 'Bar', new class() implements Stringable {


            public function __toString() : string {
                return 'Baz';
            }


        }, new Div( 'Qux' ),
        ] );
        self::assertEquals( 'FooBarBaz<div>Qux</div>', (string) $list );
    }


}
