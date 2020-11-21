<?php declare(strict_types = 1 );


namespace JDWX\HTML5\Tests;


require_once __DIR__ . '/../../../autoload.php';


use JDWX\HTML5\Elements;
use JDWX\HTML5\IElement;


/**
 * @covers \JDWX\HTML5\Element
 * @covers \JDWX\HTML5\Elements\A
 * @covers \JDWX\HTML5\Elements\Article
 * @covers \JDWX\HTML5\Elements\Aside
 * @covers \JDWX\HTML5\Elements\Br
 * @covers \JDWX\HTML5\Elements\Button
 * @covers \JDWX\HTML5\Elements\Dd
 * @covers \JDWX\HTML5\Elements\Div
 * @covers \JDWX\HTML5\Elements\Dl
 * @covers \JDWX\HTML5\Elements\Dt
 * @covers \JDWX\HTML5\Elements\Form
 * @covers \JDWX\HTML5\Elements\Footer
 * @covers \JDWX\HTML5\Elements\H1
 * @covers \JDWX\HTML5\Elements\H2
 * @covers \JDWX\HTML5\Elements\H3
 * @covers \JDWX\HTML5\Elements\H4
 * @covers \JDWX\HTML5\Elements\H5
 * @covers \JDWX\HTML5\Elements\H6
 * @covers \JDWX\HTML5\Elements\Header
 * @covers \JDWX\HTML5\Elements\Hr
 * @covers \JDWX\HTML5\Elements\Img
 * @covers \JDWX\HTML5\Elements\Input
 * @covers \JDWX\HTML5\Elements\Label
 * @covers \JDWX\HTML5\Elements\Li
 * @covers \JDWX\HTML5\Elements\Link
 * @covers \JDWX\HTML5\Elements\Main
 * @covers \JDWX\HTML5\Elements\Meta
 * @covers \JDWX\HTML5\Elements\Nav
 * @covers \JDWX\HTML5\Elements\Ol
 * @covers \JDWX\HTML5\Elements\Option
 * @covers \JDWX\HTML5\Elements\Script
 * @covers \JDWX\HTML5\Elements\Section
 * @covers \JDWX\HTML5\Elements\Select
 * @covers \JDWX\HTML5\Elements\Span
 * @covers \JDWX\HTML5\Elements\Style
 * @covers \JDWX\HTML5\Elements\TextArea
 * @covers \JDWX\HTML5\Elements\Ul
 */
class ElementsTest extends TestCase {


    private function checkSimpleContainsFoo( IElement $i_element, string $i_name, string $i_foo = "foo" ) : void {
        $this->checkElement( "<{$i_name}>{$i_foo}</{$i_name}>", $i_element );
    }


    private function checkSimpleElement( IElement $i_element, string $i_name ) : void {
        $this->checkElement( "<{$i_name}></{$i_name}>", $i_element );
    }


    private function checkSimpleUnclosed( IElement $i_element, string $i_name ) : void {
        $this->checkElement( "<{$i_name}>", $i_element );
    }


    public function testA() : void {

        $a = new Elements\A( $this->doc );
        $a->setDownload( true );
        $this->checkElement( '<a download></a>', $a );
        $a->setDownload( "baz" );
        $this->checkElement( '<a download="baz"></a>', $a );
        $a->setDownload( false );
        $this->checkElement( '<a></a>', $a );

        $a->setPing( "ping" );
        $a->addPing( "pong" );
        $a->setRel( "foo" );
        $a->addRel( "bar" );
        $a->setMedia( "qux" );
        $a->setHrefLang( "en-US" );
        $a->setTarget( "_blank" );
        $this->checkElement( '<a hreflang="en-US" media="qux" ping="ping pong" rel="foo bar" target="_blank"></a>', $a );

    }


    public function testForm() : void {
        $frm = new Elements\Form( $this->doc, "foo", "POST" );
        $frm->setEncType( "multipart/form-data" );
        $this->checkElement( '<form action="foo" enctype="multipart/form-data" method="POST"></form>', $frm );
    }


    public function testHr() : void {
        $hr = new Elements\Hr( $this->doc );
        self::assertFalse( $hr->getAlwaysClose() );
        self::assertEquals( 0, $hr->countChildren() );
        self::assertFalse( $hr->hasChildren() );
        $this->checkElement( "<hr>", $hr );
    }


    public function testImg() : void {
        $img = new Elements\Img( $this->doc, "foo" );
        $img->setAlt( "bar" );
        $this->checkElement( '<img alt="bar" src="foo">', $img );
    }


    public function testInput() : void {
        $inp = new Elements\Input( $this->doc, "foo", "text", "bar" );
        $inp->setSize( 20 );
        $inp->setMaxLength( 30 );
        $inp->setPlaceHolder( "baz" );
        $this->checkElement( '<input maxlength="30" name="foo" placeholder="baz" size="20" type="text" value="bar">', $inp );

        $inp = new Elements\Input( $this->doc );
        $this->checkElement( '<input>', $inp );
        $inp->setChecked( true );
        $this->checkElement( '<input checked>', $inp );
        $inp->setChecked( false );
        $this->checkElement( '<input>', $inp );

    }


    public function testLabel() : void {
        $lab = new Elements\Label( $this->doc );
        $lab->setFor( "foo" );
        $this->checkElement( '<label for="foo"></label>', $lab );
    }


    public function testLink() : void {
        $lnk = new Elements\Link( $this->doc, "foo", "stylesheet", "text/css" );
        $lnk->setSizes( "bar" );
        $this->checkElement( '<link href="foo" rel="stylesheet" sizes="bar" type="text/css">', $lnk );
    }


    public function testMeta() : void {
        $mta = new Elements\Meta( $this->doc );
        $mta->setCharset( "UTF-8" );
        $mta->setContent( "foo" );
        $mta->setName( "bar" );
        $this->checkElement( '<meta charset="UTF-8" content="foo" name="bar">', $mta );
    }


    public function testOption() : void {
        $opt = new Elements\Option( $this->doc );
        $opt->setValue( "foo" );
        $this->checkElement( '<option value="foo"></option>', $opt );
    }


    public function testScript() : void {
        $scr = new Elements\Script( $this->doc );
        $scr->setSrc( "foo" );
        $this->checkElement( '<script src="foo"></script>', $scr );
    }


    public function testStyle() : void {
        $sty = new Elements\Style( $this->doc );
        $this->checkElement( '<style type="text/css"></style>', $sty );
    }


    public function testTextArea() : void {
        $txt = new Elements\TextArea( $this->doc );
        $txt->setCols( 3 );
        $txt->setName( "foo" );
        $txt->setPlaceHolder( "bar" );
        $txt->setRows( 7 );
        $this->checkElement( '<textarea cols="3" name="foo" placeholder="bar" rows="7"></textarea>', $txt );
    }


    public function testSimpleElements() : void {
        $this->checkSimpleElement( new Elements\Article( $this->doc ), "article" );
        $this->checkSimpleElement( new Elements\Aside( $this->doc ), "aside" );
        $this->checkSimpleUnclosed( new Elements\Br( $this->doc ), "br" );
        $this->checkSimpleElement( new Elements\Button( $this->doc ), "button" );
        $this->checkSimpleContainsFoo( new Elements\Dd( $this->doc, "foo" ), "dd" );
        $this->checkSimpleContainsFoo( new Elements\Div( $this->doc, "foo" ), "div" );
        $this->checkSimpleElement( new Elements\Dl( $this->doc ), "dl" );
        $this->checkSimpleContainsFoo( new Elements\Dt( $this->doc, "foo" ), "dt" );
        $this->checkSimpleElement( new Elements\Footer( $this->doc ), "footer" );
        $this->checkSimpleElement( new Elements\H1( $this->doc ), "h1" );
        $this->checkSimpleElement( new Elements\H2( $this->doc ), "h2" );
        $this->checkSimpleElement( new Elements\H3( $this->doc ), "h3" );
        $this->checkSimpleElement( new Elements\H4( $this->doc ), "h4" );
        $this->checkSimpleElement( new Elements\H5( $this->doc ), "h5" );
        $this->checkSimpleElement( new Elements\H6( $this->doc ), "h6" );
        $this->checkSimpleElement( new Elements\Header( $this->doc ), "header" );
        $this->checkSimpleElement( new Elements\Li( $this->doc ), "li" );
        $this->checkSimpleElement( new Elements\Main( $this->doc ), "main" );
        $this->checkSimpleElement( new Elements\Nav( $this->doc ), "nav" );
        $this->checkSimpleElement( new Elements\Ol( $this->doc ), "ol" );
        $this->checkSimpleElement( new Elements\Section( $this->doc ), "section" );
        $this->checkSimpleElement( new Elements\Select( $this->doc ), "select" );
        $this->checkSimpleElement( new Elements\Span( $this->doc ), "span" );
        $this->checkSimpleElement( new Elements\Ul( $this->doc ), "ul" );
    }


}

