<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use InvalidArgumentException;
use JDWX\HTML5\Traits\AttributeTrait;
use PHPUnit\Framework\TestCase;


final class AttributeTest extends TestCase {


    public function testAddAttribute() : void {
        $obj = $this->newObject();
        $obj->addAttribute( 'foo', 'bar' );
        self::assertEquals( 'bar', $obj->getAttribute( 'foo' ) );
        $obj->addAttribute( 'foo', 'baz' );
        self::assertEquals( 'bar baz', $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo' );
        $obj->addAttribute( 'foo', 'bar' );
        self::assertEquals( 'bar', $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->addAttribute( 'foo', 'bar', 'baz', 'qux' );
        self::assertEquals( 'bar baz qux', $obj->getAttribute( 'foo' ) );
    }


    public function testAddAttributeForTrue() : void {
        $obj = $this->newObject();
        $obj->addAttribute( 'foo', true );
        self::assertTrue( $obj->getAttribute( 'foo' ) );
        $obj->addAttribute( 'foo', 'bar' );
        self::assertEquals( 'bar', $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->addAttribute( 'foo', 'bar' );
        $obj->addAttribute( 'foo', true );
        self::assertEquals( 'bar', $obj->getAttribute( 'foo' ) );

    }


    public function testAddAttributeFromBare() : void {
        $obj = $this->newObject();
        self::assertNull( $obj->getAttribute( 'foo' ) );
        $obj->addAttributeFromBarePub( 'foo', 'bar' );
        self::assertSame( 'bar', $obj->getAttribute( 'foo' ) );
        $obj->addAttributeFromBarePub( 'foo', 'bar', 'baz', 'qux' );
        self::assertSame( 'bar bar baz qux', $obj->getAttribute( 'foo' ) );
        $obj->addAttributeFromBarePub( 'foo', null );
        self::assertNull( $obj->getAttribute( 'foo' ) );
    }


    public function testAttributeString() : void {
        $obj = $this->newObject();
        self::assertSame( '', $obj->attributeString() );
        $obj->setAttribute( 'foo', 'bar' );
        self::assertSame( ' foo="bar"', $obj->attributeString() );
        $obj->addAttribute( 'foo', 'baz' );
        self::assertSame( ' foo="bar baz"', $obj->attributeString() );
        $obj->setAttribute( 'foo' );
        self::assertSame( ' foo', $obj->attributeString() );
    }


    public function testFluent() : void {
        $obj = $this->newObject()->setAttribute( 'foo', 'bar' )->addAttribute( 'foo', 'baz' );
        self::assertEquals( 'bar baz', $obj->getAttribute( 'foo' ) );
    }


    public function testGetAttributeEx() : void {
        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar' );
        self::assertSame( 'bar', $obj->getAttributeEx( 'foo' ) );
        $obj->removeAttribute( 'foo' );
        self::assertNull( $obj->getAttribute( 'foo' ) );
        self::expectException( InvalidArgumentException::class );
        $obj->getAttributeEx( 'foo' );
    }


    public function testGetAttributeStringEx() : void {
        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar' );
        self::assertSame( 'bar', $obj->getAttributeStringEx( 'foo' ) );
        $obj->setAttribute( 'foo', true );
        self::expectException( InvalidArgumentException::class );
        $obj->getAttributeStringEx( 'foo' );
    }


    public function testHasAttribute() : void {
        $obj = $this->newObject();
        self::assertFalse( $obj->hasAttribute( 'foo' ) );
        $obj->setAttribute( 'foo', 'bar' );
        self::assertTrue( $obj->hasAttribute( 'foo' ) );
        $obj->setAttribute( 'foo' );
        self::assertTrue( $obj->hasAttribute( 'foo' ) );
        $obj->removeAttribute( 'foo' );
        self::assertFalse( $obj->hasAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar' );
        self::assertTrue( $obj->hasAttribute( 'foo', 'bar' ) );
        $obj->addAttribute( 'foo', 'baz' );
        self::assertTrue( $obj->hasAttribute( 'foo', 'bar' ) );
        self::assertTrue( $obj->hasAttribute( 'foo', 'baz' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar' );
        self::assertFalse( $obj->hasAttribute( 'foo', 'baz' ) );
        self::assertFalse( $obj->hasAttribute( 'foo', 'qux' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'baz', 'foobar' );
        self::assertTrue( $obj->hasAttribute( 'baz' ) );
        self::assertTrue( $obj->hasAttribute( 'baz', 'foobar' ) );
        self::assertFalse( $obj->hasAttribute( 'baz', 'foo' ) );
        self::assertFalse( $obj->hasAttribute( 'baz', 'bar' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo' );
        self::assertTrue( $obj->hasAttribute( 'foo' ) );
        self::assertTrue( $obj->hasAttribute( 'foo', true ) );
        self::assertFalse( $obj->hasAttribute( 'foo', 'foo' ) );
    }


    public function testRemoveAttribute() : void {
        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar baz' );
        self::assertEquals( 'bar baz', $obj->getAttribute( 'foo' ) );
        $obj->removeAttribute( 'foo' );
        self::assertNull( $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar baz' );
        self::assertEquals( 'bar baz', $obj->getAttribute( 'foo' ) );
        $obj->removeAttribute( 'foo', 'bar' );
        self::assertEquals( 'baz', $obj->getAttribute( 'foo' ) );
        $obj->removeAttribute( 'foo', 'baz' );
        self::assertNull( $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar baz' );
        $obj->removeAttribute( 'foo', 'qux' );
        self::assertSame( 'bar baz', $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->removeAttribute( 'qux', 'quux' );
        self::assertNull( $obj->getAttribute( 'qux' ) );
    }


    public function testSetAttribute() : void {
        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar' );
        self::assertEquals( 'bar', $obj->getAttribute( 'foo' ) );
        $obj->setAttribute( 'foo', 'baz' );
        self::assertEquals( 'baz', $obj->getAttribute( 'foo' ) );
        $obj->setAttribute( 'foo' );
        self::assertTrue( $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo' );
        self::assertTrue( $obj->getAttribute( 'foo' ) );
        $obj->setAttribute( 'foo', false );
        self::assertNull( $obj->getAttribute( 'foo' ) );

        $obj = $this->newObject();
        $obj->setAttribute( 'foo', 'bar', 'baz', 'qux' );
        self::assertEquals( 'bar baz qux', $obj->getAttribute( 'foo' ) );
    }


    private function newObject() : object {
        return new class() {


            use AttributeTrait;


            /** @return array<string, bool|string> */
            public function list() : array {
                return iterator_to_array( $this->attrs() );
            }


            public function addAttributeFromBarePub( string $i_stName, string|bool|null ...$i_values ) : static {
                return $this->addAttributeFromBare( $i_stName, ... $i_values );
            }


        };
    }


}
