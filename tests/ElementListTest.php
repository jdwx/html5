<?php


declare( strict_types = 1 );


use JDWX\HTML5\ElementList;
use JDWX\HTML5\Elements\Div;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( ElementList::class )]
final class ElementListTest extends TestCase {


    public function testAppendingToElement() : void {
        $list = new ElementList( [ 'Foo', 'Bar', new class() implements Stringable {


            public function __toString() : string {
                return 'Baz';
            }


        }, new Div( 'Qux' ),
        ] );

        $el = new Div( 'Quux' );
        self::assertCount( 4, iterator_to_array( $list ) );
        self::assertSame( 1, $el->countChildren() );
        $el->append( $list );
        self::assertSame( 5, $el->countChildren() );


    }


    public function testForEach() : void {
        $str = new class() implements Stringable {


            public function __toString() : string {
                return 'Baz';
            }


        };
        $div = new Div( 'Qux' );
        $list = new ElementList( [ 'Foo', 'Bar', $str, $div ] );
        $r = [];
        foreach ( $list as $el ) {
            $r[] = $el;
        }
        self::assertSame( [ 'Foo', 'Bar', $str, $div ], $r );

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
