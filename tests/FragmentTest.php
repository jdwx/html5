<?php


declare( strict_types = 1 );


use JDWX\HTML5\Fragment;


/**
 * Class FragmentTest
 *
 * @package JDWX\HTML5\Tests
 * @covers \JDWX\HTML5\AbstractDocument
 * @covers \JDWX\HTML5\DummyDocument
 * @covers \JDWX\HTML5\Fragment
 */
class FragmentTest extends MyTestCase {


    public function testFragment() : void {
        $frg = new Fragment();
        $frg->appendChild( 'foo', $frg->escapeValue( 'bar' ), [ 'baz', 'qux' ] );
        /** @noinspection SpellCheckingInspection */
        $stExpect = 'foobarbazqux';
        self::assertEquals( $stExpect, ( string ) $frg );
    }


    public function testFragmentDummyDocument() : void {
        $frg = new Fragment();
        $doc = $frg->getDocument();
        $doc->appendChild( 'throwaway' );
        self::assertEquals( '&gt;', $doc->escapeValue( '>' ) );
    }


}

