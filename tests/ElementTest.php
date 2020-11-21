<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


use Exception;


require_once __DIR__ . '/TestCase.php';


/**
 * Class ElementTest
 *
 * @package JDWX\HTML5\Tests
 * @covers \JDWX\HTML5\Element
 */
final class ElementTest extends TestCase {


    public function testAlwaysClose() : void {

        $el = $this->element( 'test' );

        $this->checkElement( "<test></test>", $el );

        $el->setAlwaysClose( false );
        $this->checkElement( "<test>", $el );

        $el->appendChild( "text" );
        $this->checkElement( "<test>text</test>", $el );

    }


    public function testFalseAttribute() : void {
        $el = $this->element( 'foo' );
        $el->setHidden( false );
        $this->checkElement( '<foo></foo>', $el );
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

        $this->checkTrue( $el3 === $el->findChildByID( 'el3' ) );

        $this->checkTrue( $el3 === $el->findChildByID( 'el3' ) );

        $this->checkNull( $el->findChildById( 'noel3' ) );

        $this->checkFalse( $el2 === $el->findFirstChildByTagName( 'nochild' ) );

        $this->checkTrue( $el1 === $el->findFirstChildByTagName( 'child' ) );

        $el->dropChildByID( 'el1', true );

        $this->checkFalse( $el1 === $el->findFirstChildByTagName( 'child' ) );

        $this->checkTrue( $el2 === $el->findFirstChildByTagName( 'child' ) );

        $el->dropChildrenByTagName( 'child', true );
        $this->checkNull( $el->findFirstChildByTagName( 'child' ) );


    }


    public function testGetDocument() : void {
        $el = $this->element( 'foo' );
        $this->checkDocument( $el->getDocument() );
    }


    public function testGetID() : void {
        $el = $this->element( 'foo' );
        $this->checkNull( $el->getID() );
        $el->setID( 'bar' );
        self::assertEquals( 'bar', $el->getID() );
    }


    public function testHasAttribute() : void {

        $el = $this->element( 'foo' );
        $this->checkFalse( $el->hasAttribute( 'bar' ) );

        $el->setAttribute( 'bar', 'baz' );
        $this->checkTrue( $el->hasAttribute( 'bar' ) );

        $el->clearAttribute( 'bar' );
        $this->checkFalse( $el->hasAttribute( 'bar' ) );

    }


    public function testRenderChild() : void {

        $el = $this->element( 'foo' );

        self::assertEquals( 'bar',    $el->renderChild( 'bar' ) );
        self::assertEquals( '2',      $el->renderChild( 2 ) );
        self::assertEquals( '2.3',    $el->renderChild( 2.3 ) );
        self::assertEquals( 'true',   $el->renderChild( true ) );
        self::assertEquals( 'false',  $el->renderChild( false ) );
        self::assertEquals( 'barbaz', $el->renderChild([ 'bar', 'baz' ]) );
        self::assertEquals( '',       @$el->renderChild( null ) );

        try {
            $el->renderChild( fopen( '/dev/null', 'rb' ) );
            $this->checkTrue( false );
        } catch ( Exception $i_ex ) {
            $this->checkTrue( true );
        }

        $el2 = $this->element( 'qux' );
        self::assertEquals( (string) $el2, $el->renderChild( $el2 ) );

    }


    public function testToString() : void {

        $el = $this->element( 'example' );
        $el->setAttribute( 'foo', 'bar', 'baz' );
        $el->setClass( 'qux', 'quux' );
        $el->setTabIndex( 2 );
        $el->addStyle( "color: blue;" );
        $el->setStyle( "color: red;" );
        $el->addStyle( "background: none;" );
        $el->setTitle( "Titled" );
        $el->setAttribute( 'wokka', 'bop' );
        $el->clearAttribute( 'wokka' );
        $el->setContentEditable( true );
        $el->setHidden( true );
        $el->setAccessKey( 'c' );
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

        $stExpect = '<example accesskey="c" class="qux quux" contenteditable="true" dir="rtl" draggable="auto" foo="bar baz" hidden lang="en-US" spellcheck="false" style="color: red; background: none;" tabindex="2" title="Titled" translate="no"><el2></el2></example>';

        $this->checkElement( $stExpect, $el );

    }



}

