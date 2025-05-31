<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests\Gen;


require_once __DIR__ . '/../../gen/TypeGames.php';


use JDWX\HTML5\Gen\TypeGames;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( TypeGames::class )]
final class TypeGamesTest extends TestCase {


    public function testIsNullable() : void {
        self::assertTrue( TypeGames::isNullable( 'null' ) );
        self::assertTrue( TypeGames::isNullable( '?bool' ) );
        self::assertTrue( TypeGames::isNullable( '?string' ) );
        self::assertTrue( TypeGames::isNullable( 'string|null' ) );
        self::assertTrue( TypeGames::isNullable( 'string|?int' ) );
        self::assertTrue( TypeGames::isNullable( 'string|int|null' ) );
        self::assertTrue( TypeGames::isNullable( 'string|null|int' ) );
        self::assertTrue( TypeGames::isNullable( 'int|string|null' ) );
    }


    public function testRemoveNull() : void {
        self::assertSame( 'int', TypeGames::removeNull( 'int|null' ) );
        self::assertSame( 'int', TypeGames::removeNull( '?int' ) );
        self::assertSame( 'bool|int', TypeGames::removeNull( 'bool|null|int' ) );
    }


    public function testRemoveType() : void {
        self::assertSame( 'int', TypeGames::removeType( 'int|string', 'string' ) );
        self::assertSame( 'int', TypeGames::removeType( 'int|?string', '?string' ) );
        self::assertSame( 'int', TypeGames::removeType( '?int|string', '?string' ) );
        self::assertSame( 'int', TypeGames::removeType( '?int|?string', '?string' ) );
        self::assertSame( 'int', TypeGames::removeType( 'int|string|null', '?string' ) );
        self::assertSame( 'void', TypeGames::removeType( 'int', 'int' ) );
        self::assertSame( 'true', TypeGames::removeType( 'bool', 'false' ) );
        self::assertSame( 'false', TypeGames::removeType( 'bool', 'true' ) );
        self::assertSame( 'int', TypeGames::removeType( 'int|true', 'bool' ) );
        self::assertSame( 'Stringable', TypeGames::removeType( 'Stringable|false', 'bool' ) );
        self::assertSame( 'int|string', TypeGames::removeType( 'int|string', 'bool' ) );
    }


    public function testSortTypes() : void {
        self::assertSame( 'int|string', TypeGames::sortTypes( 'int|string' ) );
        self::assertSame( 'int|string', TypeGames::sortTypes( 'string|int' ) );
        self::assertSame( 'int|string', TypeGames::sortTypes( 'string|int|string' ) );
        self::assertSame( 'int|string', TypeGames::sortTypes( 'int|string|int' ) );
        self::assertSame( 'int|string|null', TypeGames::sortTypes( 'null|string|int' ) );
        self::assertSame( 'int|string|null', TypeGames::sortTypes( 'string|null|int' ) );
        self::assertSame( 'int|string|null', TypeGames::sortTypes( 'string|int|null' ) );
        self::assertSame( 'int|string|null', TypeGames::sortTypes( '?string|int' ) );
        self::assertSame( 'int|string|null', TypeGames::sortTypes( 'string|?int' ) );
        self::assertSame( 'int|string|null', TypeGames::sortTypes( 'string|?int|null' ) );
        self::assertSame( 'string|Stringable|null', TypeGames::sortTypes( 'string|Stringable|null' ) );
        self::assertSame( 'string|Stringable|null', TypeGames::sortTypes( 'Stringable|string|null' ) );
        self::assertSame( 'string|Stringable|null', TypeGames::sortTypes( '?Stringable|string' ) );
        self::assertSame( 'string|Stringable|null', TypeGames::sortTypes( 'Stringable|?string' ) );

        self::assertSame( 'bool', TypeGames::sortTypes( 'bool' ) );
        self::assertSame( 'bool', TypeGames::sortTypes( 'bool|false' ) );
        self::assertSame( 'bool', TypeGames::sortTypes( 'bool|true' ) );
        self::assertSame( 'bool', TypeGames::sortTypes( 'false|true' ) );
    }


}
