<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use JDWX\HTML5\SimpleTag;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( SimpleTag::class )]
final class SimpleTagTest extends TestCase {


    public function testToString() : void {
        $tag = new SimpleTag( 'p', 'Foo.' );
        $tag->setAttribute( 'class', 'foo' );
        self::assertSame( '<p class="foo">Foo.</p>', strval( $tag ) );
    }


}
