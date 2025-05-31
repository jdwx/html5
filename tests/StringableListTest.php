<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use JDWX\HTML5\StringableList;
use JDWX\HTML5\Tests\Shims\MyStringable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Stringable;


require_once __DIR__ . '/Shims/MyStringable.php';


#[CoversClass( StringableList::class )]
final class StringableListTest extends TestCase {


    public function testAppend() : void {
        $el = new StringableList();
        $el->append( 'Bar', [ 'Baz', 'Qux' ] );
        self::assertEquals( 'BarBazQux', strval( $el ) );

        $child = new StringableList( 'Quux' );
        $el = new StringableList( 'Foo' );
        $el->append( 'Bar', [ 'Baz', $child, [ 'Qux', null ] ] );
        self::assertSame( 'FooBarBazQuuxQux', strval( $el ) );
    }


    public function testAppendChild() : void {
        $list = new StringableList( 'Foo' );
        $list->appendChild( 'Bar' );
        self::assertSame( 'FooBar', strval( $list ) );

        $list = new StringableList( 'Foo' );
        $list->appendChild( null )
            ->appendChild( new StringableList( 'Bar' ) );
        self::assertCount( 2, $list );
        self::assertSame( 'FooBar', strval( $list ) );
    }


    public function testChildren() : void {
        $el = new StringableList( [ 'foo', 'bar', 'baz' ] );
        self::assertSame( [ 'foo', 'bar', 'baz' ], iterator_to_array( $el->children(), false ) );
    }


    public function testCount() : void {
        $el1 = new MyStringable();
        $el2 = new MyStringable();
        $el3 = 'Foo';
        $el4 = new MyStringable( 'Bar' );
        $list = new StringableList( [ $el1, $el2, $el3, $el4 ] );
        self::assertCount( 4, $list );
    }


    public function testNthChild() : void {
        $baz = new MyStringable( 'Baz' );
        $qux = new MyStringable( 'Qux' );
        $list = new StringableList( [ 'Foo', 'Bar', $baz, $qux ] );
        self::assertSame( 'Foo', strval( $list->nthChild( 0 ) ) );
        self::assertSame( 'Bar', strval( $list->nthChild( 1 ) ) );
        self::assertSame( $baz, $list->nthChild( 2 ) );
        self::assertSame( $qux, $list->nthChild( 3 ) );
        self::assertNull( $list->nthChild( 4 ) );
    }


    public function testPrependChild() : void {
        $el = new StringableList( 'Bar' );
        $el->prependChild( 'Foo' );
        self::assertSame( 'FooBar', strval( $el ) );

        $el = new StringableList( 'Bar' );
        $el->prependChild( null )
            ->prependChild( new StringableList( 'Foo' ) );
        self::assertSame( 'FooBar', strval( $el ) );
    }


    public function testRemoveAllChildren() : void {
        $el = new StringableList( [ 'foo', 'bar', 'baz' ] );
        $el->removeAllChildren();
        self::assertSame( '', strval( $el ) );
    }


    public function testRemoveChildForNotPresent() : void {
        $child = new MyStringable( 'Foo' );
        $parent = new StringableList( [ 'Bar', 'Baz' ] );
        $parent->removeChild( $child );
        self::assertSame( 'BarBaz', strval( $parent ) );
    }


    public function testRemoveChildForString() : void {
        $el = new StringableList( [ 'Foo', 'Bar', 'Baz' ] );
        $el->removeChild( 'Bar' );
        self::assertSame( 'FooBaz', strval( $el ) );
    }


    public function testRemoveChildForStringable() : void {
        $child = new MyStringable( 'Foo' );
        $parent = new StringableList( [ 'Bar', $child, 'Baz' ] );
        $parent->removeChild( $child );
        self::assertSame( 'BarBaz', strval( $parent ) );
    }


    public function testRemoveChildren() : void {
        $el = new StringableList( [ 'Foo', 'Bar', 'Baz', new MyStringable( 'Bar' ) ] );
        $fn = function ( string|Stringable $child ) : bool {
            return 'Bar' === strval( $child );
        };
        $el->removeChildren( $fn );
        self::assertSame( 'FooBaz', strval( $el ) );
    }


    public function testRemoveNthChild() : void {
        $el = new StringableList( [ 'Foo', 'Bar', 'Baz' ] );
        $el->removeNthChild();
        self::assertSame( 'BarBaz', strval( $el ) );

        $el = new StringableList( [ 'Foo', 'Bar', 'Baz' ] );
        $el->removeNthChild( 1 );
        self::assertSame( 'FooBaz', strval( $el ) );

        $el = new StringableList( [ 'Foo', 'Bar', 'Baz' ] );
        $el->removeNthChild( 2 );
        self::assertSame( 'FooBar', strval( $el ) );

        $el = new StringableList( [ 'Foo', 'Bar', 'Baz' ] );
        $el->removeNthChild( 3 );
        self::assertSame( 'FooBarBaz', strval( $el ) );
    }


    public function testStream() : void {
        $baz = new MyStringable( 'Baz' );
        $qux = new MyStringable( 'Qux' );
        $list = new StringableList( [ 'Foo', 'Bar', $baz, $qux ] );
        $r = [];
        foreach ( $list->stream() as $el ) {
            $r[] = $el;
        }
        self::assertSame( [ 'Foo', 'Bar', $baz, $qux ], $r );
    }


}
