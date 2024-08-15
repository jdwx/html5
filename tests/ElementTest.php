<?php declare( strict_types = 1 );


use JDWX\HTML5\IDocument;


require_once __DIR__ . '/MyTestCase.php';


/**
 * Class ElementTest
 *
 * @package JDWX\HTML5\Tests
 * @covers \JDWX\HTML5\Element
 */
final class ElementTest extends MyTestCase {


    public function testAddClass() : void {
        $el = $this->element( 'test' );
        $el->addClass( 'foo' );
        self::assertEquals( "<test class=\"foo\"></test>", $el );
    }


    public function testAlwaysClose() : void {

        $el = $this->element( 'test' );

        self::assertEquals( '<test></test>', $el );

        $el->setAlwaysClose( false );
        /** @noinspection PhpConditionAlreadyCheckedInspection */
        self::assertEquals( '<test>', $el );

        $el->appendChild( 'text' );
        /** @noinspection PhpConditionAlreadyCheckedInspection */
        self::assertEquals( '<test>text</test>', $el );

    }


    public function testAppendChild() : void {
        $el = $this->element( 'foo' );
        $el->appendChild( 'bar', [ 'baz', 'qux' ] );
        self::assertEquals( '<foo>barbazqux</foo>', $el );
    }


    public function testFalseAttribute() : void {
        $el = $this->element( 'foo' );
        $el->setHidden( false );
        self::assertEquals( '<foo></foo>', $el );
    }


    public function testFindFirst() : void {

        $el = $this->element( 'foo' );
        $el1 = $this->element( 'child' );
        $el1->setID( 'el1' );
        $el2 = $this->element( 'child' );
        $el2->setID( 'el2' );
        $el3 = $this->element( 'child' );
        $el3->setID( 'el3' );
        $el4 = $this->element( 'bar' );
        $el->appendChild( $el1, $el2, $el3, $el4 );

        self::assertTrue( $el3 === $el->findChildById( 'el3' ) );

        self::assertTrue( $el3 === $el->findChildById( 'el3' ) );

        self::assertNull( $el->findChildById( 'noel3' ) );

        self::assertFalse( $el2 === $el->findFirstChildByTagName( 'nochild' ) );

        self::assertTrue( $el1 === $el->findFirstChildByTagName( 'child' ) );

        $el->dropChildByID( 'el1', true );

        self::assertFalse( $el1 === $el->findFirstChildByTagName( 'child' ) );

        self::assertTrue( $el2 === $el->findFirstChildByTagName( 'child' ) );

        $el->dropChildrenByTagName( 'child', true );

        self::assertNull( $el->findFirstChildByTagName( 'child' ) );


    }


    public function testGetDocument() : void {
        $el = $this->element( 'foo' );
        self::assertInstanceOf( IDocument::class, $el->getDocument() );
    }


    public function testGetID() : void {
        $el = $this->element( 'foo' );
        self::assertNull( $el->getID() );
        $el->setID( 'bar' );
        self::assertEquals( 'bar', $el->getID() );
    }


    public function testHasAttribute() : void {

        $el = $this->element( 'foo' );
        self::assertFalse( $el->hasAttribute( 'bar' ) );

        $el->setAttribute( 'bar', 'baz' );
        self::assertTrue( $el->hasAttribute( 'bar' ) );

        $el->clearAttribute( 'bar' );
        self::assertFalse( $el->hasAttribute( 'bar' ) );

    }


    public function testRenderChild() : void {

        $el = $this->element( 'foo' );

        self::assertEquals( 'bar', $el->myRenderChild( 'bar' ) );
        self::assertEquals( '2', $el->myRenderChild( 2 ) );
        self::assertEquals( '2.3', $el->myRenderChild( 2.3 ) );
        self::assertEquals( 'true', $el->myRenderChild( true ) );
        self::assertEquals( 'false', $el->myRenderChild( false ) );
        self::assertEquals( 'barbaz', $el->myRenderChild( [ 'bar', 'baz' ] ) );
        self::assertEquals( '', $el->myRenderChild( null ) );

        $el2 = $this->element( 'qux' );
        self::assertEquals( (string) $el2, $el->myRenderChild( $el2 ) );

        self::assertSame( '', $el->myRenderChild( fopen( '/dev/null', 'rb' ) ) );
    }


    public function testSetChecked() : void {
        $el = $this->element( 'foo' );
        $el->setChecked( true );
        self::assertEquals( '<foo checked></foo>', strval( $el ) );

        $el->setChecked( false );
        self::assertEquals( '<foo></foo>', strval( $el ) );
    }


    public function testSetClass() : void {
        $el = $this->element( 'foo' );
        $el->setClass( 'bar', 'baz' );
        self::assertEquals( '<foo class="bar baz"></foo>', strval( $el ) );
        $el->setClass( null );
        self::assertEquals( '<foo></foo>', strval( $el ) );
    }


    public function testSetRequired() : void {
        $el = $this->element( 'foo' );
        $el->setRequired( true );
        self::assertEquals( '<foo required></foo>', strval( $el ) );

        $el->setRequired( false );
        self::assertEquals( '<foo></foo>', strval( $el ) );
    }


    public function testToString() : void {

        $el = $this->element( 'example' );
        $el->setAccessKey( 'c' );
        $el->setAttribute( 'foo', 'bar', 'baz' );
        $el->setAriaLabel( 'Close' );
        $el->setClass( 'qux', 'quux' );
        $el->setTabIndex( 2 );
        $el->addStyle( 'color: blue;' );
        $el->setStyle( 'color: red;' );
        $el->addStyle( 'background: none;' );
        $el->setTitle( 'Titled' );
        $el->setAttribute( 'wokka', 'bop' );
        $el->clearAttribute( 'wokka' );
        $el->setContentEditable( true );
        $el->setHidden( true );
        $el->setDir( 'rtl' );
        $el->setDraggable( false );
        $el->setDraggable( 'auto' );
        $el->setTranslate( false );
        $el->setSpellCheck( false );
        $el->setLang( 'en-US' );

        $el2 = $this->element( 'el2' );
        $el3 = $this->element( 'el3' );
        $el->appendChild( $el2, $el3 );
        $el->dropChildrenByTagName( 'el3' );

        $stExpect = '<example accessKey="c" aria-label="Close" class="qux quux" contenteditable="true" dir="rtl" draggable="auto" foo="bar baz" hidden lang="en-US" spellcheck="false" style="color: red; background: none;" tabindex="2" title="Titled" translate="no"><el2></el2></example>';

        self::assertEquals( $stExpect, $el );

    }


}

