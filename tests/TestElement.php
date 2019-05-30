<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;
require_once __DIR__ . '/ElementHack.php';


class TestElement extends Harness {


	function element( string $i_stTag ) : ElementHack {
		return new ElementHack( $this->moc, $i_stTag );
	}


	function testAlwaysClose() : void {

		$el = $this->element( 'test' );

		$this->checkElement( "<test></test>", $el );

		$el->setAlwaysClose( false );
		$this->checkElement( "<test>", $el );

		$el->appendChild( "text" );
		$this->checkElement( "<test>text</test>", $el );

	}


	function testFalseAttribute() : void {
		$el = $this->element( 'foo' );
		$el->setHidden( false );
		$this->checkElement( '<foo></foo>', $el );
	}


	function testFindFirst() : void {

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


	function testGetDocument() : void {
		$el = $this->element( 'foo' );
		$this->checkDocument( $el->getDocument() );
	}


	function testGetID() : void {
		$el = $this->element( 'foo' );
		$this->checkNull( $el->getID() );
		$el->setID( 'bar' );
		$this->check( 'bar', $el->getID() );
	}


	function testHasAttribute() : void {

		$el = $this->element( 'foo' );
		$this->checkFalse( $el->hasAttribute( 'bar' ) );

		$el->setAttribute( 'bar', 'baz' );
		$this->checkTrue( $el->hasAttribute( 'bar' ) );

		$el->clearAttribute( 'bar' );
		$this->checkFalse( $el->hasAttribute( 'bar' ) );

	}


	function testRenderChild() : void {

		$el = $this->element( 'foo' );

		$this->check( 'bar',    $el->renderChild( 'bar' ) );
		$this->check( '2',      $el->renderChild( 2 ) );
		$this->check( '2.3',    $el->renderChild( 2.3 ) );
		$this->check( 'true',   $el->renderChild( true ) );
		$this->check( 'false',  $el->renderChild( false ) );
		$this->check( 'barbaz', $el->renderChild([ 'bar', 'baz' ]) );
		$this->check( '',       @$el->renderChild( null ) );

		try {
			$el->renderChild( fopen( '/dev/null', 'r' ) );
			$this->checkTrue( false );
		} catch ( \Exception $i_ex ) {
			$this->checkTrue( true );
		}

		$el2 = $this->element( 'qux' );
		$this->check( strval( $el2 ), $el->renderChild( $el2 ) );

	}


	function testToString() : void {

		$el = $this->element( 'example' );
		$el->setAttribute( 'foo', 'bar', 'baz' );
		$el->setClass( 'qux', 'quux' );
		$el->setTabIndex( 2 );
		$el->addStyle( "color: blue;" );
		$el->setStyle( "color: red;" );
		$el->addStyle( "style: yes;" );
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

		$stExpect = '<example accesskey="c" class="qux quux" contenteditable="true" dir="rtl" draggable="auto" foo="bar baz" hidden lang="en-US" spellcheck="false" style="color: red; style: yes;" tabindex="2" title="Titled" translate="no"><el2></el2></example>';

		$this->check( $stExpect, strval( $el ) );

	}


}


