<?php declare( strict_types = 1 );


use JDWX\HTML5\Element;


require_once __DIR__ . '/MyTestCase.php';


/**
 * Class ElementTest
 *
 * @package JDWX\HTML5\Tests
 * @covers \JDWX\HTML5\Element
 */
final class ElementTest extends MyTestCase {


    public function testAddClass() : void {
        $el = new Element( 'test' );
        $el->class( 'foo' );
        self::assertEquals( "<div class=\"foo\">test</div>", strval( $el ) );
    }


    public function testAlwaysClose() : void {

        $el = new Element();
        self::assertEquals( '<div></div>', strval( $el ) );

        $el->setAlwaysClose( false );
        /** @noinspection PhpConditionAlreadyCheckedInspection */
        self::assertEquals( '<div>', $el );

        $el->appendChild( 'Foo' );
        /** @noinspection PhpConditionAlreadyCheckedInspection */
        self::assertEquals( '<div>Foo</div>', $el );

    }


    public function testAppend() : void {
        $el = new Element();
        $el->append( 'Bar', [ 'Baz', 'Qux' ] );
        self::assertEquals( '<div>BarBazQux</div>', strval( $el ) );
    }


    public function testFalseAttribute() : void {
        $el = new Element();
        $el->hidden();
        self::assertEquals( '<div hidden></div>', strval( $el ) );
        $el->hidden( false );
        self::assertEquals( '<div></div>', strval( $el ) );
    }


    /*
    public function testGetDocument() : void {
        $el = $this->element( 'foo' );
        self::assertInstanceOf( DocumentInterface::class, $el->getDocument() );
    }
    */


    public function testGetElementById() : void {

        $el = new Element();
        $el1 = Element::synthetic( 'child' );
        $el1->id( 'el1' );
        $el2 = new Element();
        $el2->id( 'el2' );
        $el3 = Element::synthetic( 'child' );
        $el3->id( 'el3' );
        $el4 = Element::synthetic( 'child' );
        $el4->id( 'el4' );
        $el->append( $el1, $el2, $el3, $el4 );

        self::assertTrue( $el1 === $el->getElementById( 'el1' ) );
        self::assertTrue( $el2 === $el->getElementById( 'el2' ) );
        self::assertTrue( $el3 === $el->getElementById( 'el3' ) );
        self::assertTrue( $el4 === $el->getElementById( 'el4' ) );
        self::assertNull( $el->getElementById( 'el5' ) );
    }


    public function testGetId() : void {
        $el = $this->element( 'foo' );
        self::assertNull( $el->getId() );
        $el->id( 'bar' );
        self::assertEquals( 'bar', $el->getId() );
    }


    public function testGetIdEx() : void {
        $el = $this->element( 'foo' );
        $el->id( 'bar' );
        self::assertEquals( 'bar', $el->getIdEx() );

        $el = $this->element( 'foo' );
        self::expectException( InvalidArgumentException::class );
        $el->getIdEx();
    }


    public function testHasAttribute() : void {

        $el = $this->element( 'foo' );
        self::assertFalse( $el->hasAttribute( 'bar' ) );

        $el->setAttribute( 'bar', 'baz' );
        self::assertTrue( $el->hasAttribute( 'bar' ) );

        $el->removeAttribute( 'bar' );
        self::assertFalse( $el->hasAttribute( 'bar' ) );

    }


    public function testNthChildElementByClass() : void {

        $el = new Element();
        $el1 = Element::synthetic( 'child' );
        $el1->id( 'el1' );
        $el1->class( 'foo' );
        $el2 = new Element();
        $el2->id( 'el2' );
        $el2->class( 'bar' );
        $el3 = Element::synthetic( 'child' );
        $el3->id( 'el3' );
        $el3->class( 'foo' )->class( 'bar' );
        $el4 = Element::synthetic( 'child' );
        $el4->id( 'el4' );
        $el->append( $el1, $el2, $el3, $el4 );

        self::assertSame( $el1, $el->nthChildElementByClass( 'foo' ) );
        self::assertSame( $el3, $el->nthChildElementByClass( 'foo', 1 ) );
        self::assertNull( $el->nthChildElementByClass( 'foo', 2 ) );

        self::assertSame( $el2, $el->nthChildElementByClass( 'bar' ) );
        self::assertSame( $el3, $el->nthChildElementByClass( 'bar', 1 ) );
        self::assertNull( $el->nthChildElementByClass( 'bar', 2 ) );

    }


    public function testNthChildElementByTagName() : void {

        $el = new Element();
        $el1 = Element::synthetic( 'child' );
        $el1->id( 'el1' );
        $el2 = new Element();
        $el2->id( 'el2' );
        $el3 = Element::synthetic( 'child' );
        $el3->id( 'el3' );
        $el4 = Element::synthetic( 'child' );
        $el4->id( 'el4' );
        $el->append( $el1, $el2, $el3, $el4 );

        self::assertSame( $el1, $el->nthChildElementByTagName( 'child' ) );
        self::assertSame( $el3, $el->nthChildElementByTagName( 'child', 1 ) );
        self::assertSame( $el4, $el->nthChildElementByTagName( 'child', 2 ) );
        self::assertNull( $el->nthChildElementByTagName( 'child', 3 ) );

        self::assertSame( $el2, $el->nthChildElementByTagName( 'div' ) );
        self::assertNull( $el->nthChildElementByTagName( 'div', 1 ) );

        self::assertNull( $el->nthChildElementByTagName( 'Foo' ) );

    }


    /*
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
    */


    public function testSetClass() : void {
        $el = new Element( 'foo' );
        $el->setClass( 'bar baz' );
        self::assertEquals( '<div class="bar baz">foo</div>', strval( $el ) );
        $el->setClass( false );
        self::assertEquals( '<div>foo</div>', strval( $el ) );
    }


    /*
    public function testSetRequired() : void {
        $el = $this->element( 'foo' );
        $el->setRequired( true );
        self::assertEquals( '<foo required></foo>', strval( $el ) );

        $el->setRequired( false );
        self::assertEquals( '<foo></foo>', strval( $el ) );
    }
    */


    public function testToString() : void {

        $el = $this->element( 'example' );
        $el->setAccessKey( 'c' );
        $el->setAttribute( 'foo', 'bar', 'baz' );
        $el->ariaLabel( 'Close' );
        $el->class( 'qux', 'quux' );
        $el->tabIndex( 2 );
        $el->addStyle( 'color: blue;' );
        $el->setStyle( 'color: red;' );
        $el->addStyle( 'background: none;' );
        $el->setTitle( 'Titled' );
        $el->setAttribute( 'wokka', 'bop' );
        $el->removeAttribute( 'wokka' );
        $el->contentEditable();
        $el->hidden();
        $el->setDir( 'rtl' );
        $el->draggable( false );
        $el->draggable();
        $el->translate( false );
        $el->spellCheck( false );
        $el->setLang( 'en-US' );

        $el2 = Element::synthetic( 'el2' );
        $el3 = ( new Element() )->id( 'el3' );
        $el->append( $el2, $el3 );
        $el->removeChildById( 'el3' );

        /** @noinspection HtmlUnknownAttribute */
        $stExpect =
            '<div accesskey="c" aria-label="Close" class="qux quux" contenteditable="true" dir="rtl" draggable="true" foo="bar baz" hidden lang="en-US" spellcheck="false" style="color: red; background: none;" tabindex="2" title="Titled" translate="no">example<el2></el2></div>';

        self::assertEquals( $stExpect, strval( $el ) );

    }


}

