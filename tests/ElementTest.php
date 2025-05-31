<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use InvalidArgumentException;
use JDWX\HTML5\AttributeModifier;
use JDWX\HTML5\Element;
use JDWX\HTML5\ElementList;
use JDWX\HTML5\Elements\Div;
use JDWX\HTML5\Elements\Img;
use JDWX\HTML5\Tests\Shims\MyTestCase;
use JDWX\Web\Stream\SimpleStringable;
use JDWX\Web\Stream\StringableList;
use PHPUnit\Framework\Attributes\CoversClass;
use Stringable;


require_once __DIR__ . '/Shims/MyTestCase.php';


#[CoversClass( Element::class )]
final class ElementTest extends MyTestCase {


    public function testAddChildClasses() : void {
        $foo = new Element();
        $bar = new Element();
        $baz = new Element();
        $grault = new Element();
        $div = new Element( [ $foo, $bar, 'garply', $baz, $grault ] );
        $div->addChildClasses( 'qux', 'quux', 'corge' );
        self::assertSame( 'qux', $foo->getClass() );
        self::assertSame( 'quux', $bar->getClass() );
        self::assertSame( 'corge', $baz->getClass() );
        self::assertNull( $grault->getClass() );
    }


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

        $el = new Element();
        self::assertTrue( $el->getAlwaysClose() );
        $el->setAlwaysClose( false );

        self::assertFalse( $el->getAlwaysClose() );
        $el->setAlwaysClose( true );
        self::assertTrue( $el->getAlwaysClose() );

    }


    public function testAppendForElementList() : void {
        $foo = new Element();
        $bar = new Element();
        $baz = new Element();
        $qux = new Element();
        $list = new ElementList( [ $bar, $baz, $qux ] );
        $el = new Element( $foo );
        $el->append( $list );
        self::assertSame( [ $foo, $bar, $baz, $qux ], iterator_to_array( $el->children(), false ) );
    }


    public function testAppendForModifier() : void {
        $mod = new AttributeModifier( 'class', 'foo', 'Foo' );
        $foo = new Element();
        $foo->append( $mod );
        self::assertSame( '<div class="foo">Foo</div>', strval( $foo ) );
    }


    public function testAppendForStringableList() : void {
        $foo = new SimpleStringable( 'Foo' );
        $bar = new SimpleStringable( 'Bar' );
        $baz = new SimpleStringable( 'Baz' );
        $qux = new SimpleStringable( 'Qux' );
        $list = new StringableList( [ $bar, $baz, $qux ] );
        $el = Element::synthetic( 'div', $foo );
        $el->append( $list );
        self::assertSame( [ $foo, $bar, $baz, $qux ], iterator_to_array( $el->children(), false ) );
        self::assertSame( '<div>FooBarBazQux</div>', strval( $el ) );
    }


    public function testChildElements() : void {
        $elChild = new Element( i_children: 'foo' );
        $elParent = new Element( i_children: [ $elChild, 'bar' ] );
        self::assertSame( [ $elChild ], iterator_to_array( $elParent->childElements(), false ) );
    }


    public function testChildElementsWithFilter() : void {
        $elChild1 = ( new Element( i_children: 'foo' ) )->setAttribute( 'pick' );
        $elChild2 = new Element( i_children: 'bar' );
        $elChild3 = ( new Element( i_children: 'baz' ) )->setAttribute( 'pick' );
        $elChild4 = new Element( i_children: 'qux' );
        $elParent =
            new Element( i_children: [ 'Quux', $elChild1, 'Corge', $elChild2, 'Grault', $elChild3, 'Garply', $elChild4 ] );
        $fn = function ( Element $child ) : bool {
            return $child->hasAttribute( 'pick' );
        };
        self::assertSame( [ $elChild1, $elChild3 ], iterator_to_array( $elParent->childElements( $fn ), false ) );
    }


    public function testCountChildElements() : void {
        $el1 = new Element();
        $el2 = new Element();
        $el3 = 'Foo';
        $el4 = new class() implements Stringable {


            public function __toString() : string {
                return 'Bar';
            }


        };
        $parent = new Element( [ $el1, $el2, $el3, $el4 ] );
        self::assertSame( 2, $parent->countChildElements() );
    }


    public function testFalseAttribute() : void {
        $el = new Element();
        $el->hidden();
        self::assertEquals( '<div hidden></div>', strval( $el ) );
        $el->hidden( false );
        self::assertEquals( '<div></div>', strval( $el ) );
    }


    public function testFilterByHasAttribute() : void {
        $elChild1 = ( new Element( i_children: 'foo' ) )->setAttribute( 'pick' );
        $elChild2 = new Element( i_children: 'bar' );
        $elChild3 = ( new Element( i_children: 'baz' ) )->setAttribute( 'pick', 'yes' );
        $elChild4 = new Element( i_children: 'qux' );
        $elParent = new Element(
            i_children: [ 'Quux', $elChild1, 'Corge', $elChild2, 'Grault', $elChild3, 'Garply', $elChild4 ]
        );
        $x = $elParent->children( Element::filterByHasAttribute( 'pick' ) );
        self::assertSame( [ $elChild1, $elChild3 ], iterator_to_array( $x, false ) );
        $x = $elParent->children( Element::filterByHasAttribute( 'pick', 'yes' ) );
        self::assertSame( [ $elChild3 ], iterator_to_array( $x, false ) );
    }


    public function testFilterByHasTagName() : void {
        $el1 = Element::synthetic( 'foo' );
        $el2 = Element::synthetic( 'bar' )->setAttribute( 'class', 'foo' );
        $el3 = Element::synthetic( 'foo', 'baz' );
        $el4 = 'foo';
        $el5 = new class() implements Stringable {


            public function __toString() : string {
                return 'foo';
            }


        };
        $parent = new Element( [ $el1, $el2, $el3, $el4, $el5 ] );
        $x = $parent->children( Element::filterByTagName( 'foo' ) );
        self::assertSame( [ $el1, $el3 ], iterator_to_array( $x, false ) );

    }


    public function testFilterByNotHasAttribute() : void {
        $elChild1 = ( new Element() )->setAttribute( 'pick' );
        $elChild2 = new Element();
        $elChild3 = ( new Element() )->setAttribute( 'pick', 'yes' );
        $elChild4 = new Element();
        $elParent = new Element(
            i_children: [ 'Quux', $elChild1, $elChild2, $elChild3, $elChild4 ]
        );
        $x = $elParent->children( Element::filterByNotHasAttribute( 'pick' ) );
        self::assertSame( [ 'Quux', $elChild2, $elChild4 ], iterator_to_array( $x, false ) );

        $x = $elParent->children( Element::filterByNotHasAttribute( 'pick', 'yes' ) );
        self::assertSame( [ 'Quux', $elChild1, $elChild2, $elChild4 ], iterator_to_array( $x, false ) );

        $x = $elParent->childElements( Element::filterByNotHasAttribute( 'pick' ) );
        self::assertSame( [ $elChild2, $elChild4 ], iterator_to_array( $x, false ) );
    }


    public function testFilterByNotTagName() : void {
        $el1 = Element::synthetic( 'foo' );
        $el2 = Element::synthetic( 'bar' )->setAttribute( 'class', 'foo' );
        $el3 = Element::synthetic( 'foo', 'baz' );
        $el4 = 'foo';
        $el5 = new class() implements Stringable {


            public function __toString() : string {
                return 'foo';
            }


        };
        $parent = new Element( [ $el1, $el2, $el3, $el4, $el5 ] );
        $x = $parent->children( Element::filterByNotTagName( 'foo' ) );
        self::assertSame( [ $el2, $el4, $el5 ], iterator_to_array( $x, false ) );

    }


    /** @suppress PhanTypeNoAccessiblePropertiesForeach */
    public function testForEach() : void {
        $el = new Element( [ 'Foo', 'Bar', 'Baz' ] );
        $bNo = false;
        $st = '';
        /** @phpstan-ignore foreach.nonIterable */
        foreach ( $el as $x ) {
            $bNo = true;
            $st .= $x;
        }
        self::assertFalse( $bNo );
        self::assertSame( '', $st );
    }


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


    public function testIsIterable() : void {
        $el = new Element( 'test' );
        /** @phpstan-ignore function.impossibleType */
        self::assertFalse( is_iterable( $el ) );
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


    public function testNthChildElementByNotClass() : void {
        $el = new Element();
        $el1 = Element::synthetic( 'child' )->id( 'el1' )->class( 'foo' );
        $el2 = ( new Element() )->id( 'el2' )->class( 'bar' );
        $el3 = Element::synthetic( 'child' )->id( 'el3' )->class( 'foo' );
        $el4 = Element::synthetic( 'child' )->id( 'el4' );
        $el->append( $el1, 'baz', $el2, $el3, $el4 );

        self::assertSame( $el2, $el->nthChildElementByNotClass( 'foo' ) );
        self::assertSame( $el4, $el->nthChildElementByNotClass( 'foo', 1 ) );
    }


    public function testNthChildElementByNotTagName() : void {
        $el = new Element();
        $el1 = Element::synthetic( 'child' )->id( 'el1' )->class( 'foo' );
        $el2 = ( new Element() )->id( 'el2' )->class( 'bar' );
        $el3 = Element::synthetic( 'child' )->id( 'el3' )->class( 'foo' );
        $el4 = Element::synthetic( 'el4' )->id( 'el4' );
        $el->append( $el1, 'baz', $el2, $el3, $el4 );

        self::assertSame( $el2, $el->nthChildElementByNotTagName( 'child' ) );
        self::assertSame( $el4, $el->nthChildElementByNotTagName( 'child', 1 ) );
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


    public function testRemoveNthChildElement() : void {
        $elChild1 = new Element( i_children: 'Foo' );
        $elChild2 = new Element( i_children: 'Bar' );
        $el = new Element( i_children: [ 'Baz', $elChild1, 'Qux', $elChild2, 'Corge' ] );
        $el->removeNthChildElement();
        self::assertSame( '<div>BazQux<div>Bar</div>Corge</div>', strval( $el ) );

        $el = new Element( i_children: [ 'Baz', $elChild1, 'Qux', $elChild2, 'Corge' ] );
        $el->removeNthChildElement( 1 );
        self::assertSame( '<div>Baz<div>Foo</div>QuxCorge</div>', strval( $el ) );

        $el = new Element( i_children: [ 'Baz', $elChild1, 'Qux', $elChild2, 'Corge' ] );
        $el->removeNthChildElement( 2 );
        self::assertSame( '<div>Baz<div>Foo</div>Qux<div>Bar</div>Corge</div>', strval( $el ) );
    }


    public function testSetClass() : void {
        $el = new Element( 'foo' );
        $el->setClass( 'bar baz' );
        self::assertEquals( '<div class="bar baz">foo</div>', strval( $el ) );
        $el->setClass( false );
        self::assertEquals( '<div>foo</div>', strval( $el ) );
    }


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


    public function testToStringForIterable() : void {
        $el = new Element( i_children: [ 'foo', 'bar' ] );
        self::assertSame( '<div>foobar</div>', strval( $el ) );
    }


    public function testToStringForNoClose() : void {
        $el = new Element( i_children: 'foo' );
        $el->setAlwaysClose( false );
        self::assertSame( '<div>foo</div>', strval( $el ) );

        $el = new Element();
        $el->setAlwaysClose( false );
        self::assertSame( '<div>', strval( $el ) );
    }


    public function testToStringForString() : void {
        $el = new Element( i_children: 'foo' );
        self::assertSame( '<div>foo</div>', strval( $el ) );
    }


    public function testToStringForStringable() : void {
        $foo = new SimpleStringable( 'Foo' );
        $el = new Element( i_children: $foo );
        self::assertSame( '<div>Foo</div>', strval( $el ) );
    }


    public function testWithParent() : void {
        $div = new Div();
        $img = ( new Img() )->alt( 'foo' );
        $img->withParent( $div );
        self::assertSame( '<div><img alt="foo"></div>', strval( $div ) );
    }


}

