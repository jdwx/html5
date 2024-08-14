<?php declare( strict_types = 1 );


require_once __DIR__ . '/../vendor/autoload.php';


use JDWX\HTML5\Elements;
use JDWX\HTML5\IElement;


class ElementsTest extends MyTestCase {


    /** @noinspection PhpConditionAlreadyCheckedInspection */
    public function testA() : void {

        $a = new Elements\A( $this->doc );
        $a->setDownload( true );
        self::assertEquals( '<a download></a>', $a );
        $a->setDownload( 'baz' );
        self::assertEquals( '<a download="baz"></a>', $a );
        $a->setDownload( false );
        self::assertEquals( '<a></a>', $a );

        $a->setPing( 'ping' );
        $a->addPing( 'pong' );
        $a->setRel( 'foo' );
        $a->addRel( 'bar' );
        $a->setMedia( 'qux' );
        $a->setHrefLang( 'en-US' );
        $a->setTarget( '_blank' );
        /** @noinspection HtmlUnknownAttribute */
        self::assertEquals( '<a hreflang="en-US" media="qux" ping="ping pong" rel="foo bar" target="_blank"></a>', $a );

    }


    public function testFieldset() : void {
        $fld = new Elements\Fieldset( $this->doc );
        $fld->setDisabled( true );
        $fld->setForm( 'foo' );
        $fld->setName( 'bar' );
        self::assertEquals( '<fieldset disabled form="foo" name="bar"></fieldset>', $fld );
    }


    /** @noinspection HtmlUnknownTarget */
    public function testForm() : void {
        $frm = new Elements\Form( $this->doc, 'foo', 'POST' );
        $frm->setEncType( 'multipart/form-data' );
        self::assertEquals( '<form action="foo" enctype="multipart/form-data" method="POST"></form>', $frm );
    }


    public function testHr() : void {
        $hr = new Elements\Hr( $this->doc );
        self::assertFalse( $hr->getAlwaysClose() );
        self::assertEquals( 0, $hr->countChildren() );
        self::assertFalse( $hr->hasChildren() );
        self::assertEquals( '<hr>', $hr );
    }


    /** @noinspection HtmlUnknownTarget */
    public function testImg() : void {
        $img = new Elements\Img( $this->doc, 'foo' );
        $img->setAlt( 'bar' );
        self::assertEquals( '<img alt="bar" src="foo">', $img );
    }


    /** @noinspection PhpConditionAlreadyCheckedInspection */
    public function testInput() : void {
        $inp = new Elements\Input( $this->doc, 'foo', 'text', 'bar' );
        $inp->setSize( 20 );
        $inp->setMaxLength( 30 );
        $inp->setPlaceHolder( 'baz' );
        self::assertEquals( '<input maxlength="30" name="foo" placeholder="baz" size="20" type="text" value="bar">', $inp );

        $inp = new Elements\Input( $this->doc );
        self::assertEquals( '<input>', $inp );
        $inp->setChecked( true );
        self::assertEquals( '<input checked>', $inp );
        $inp->setChecked( false );
        self::assertEquals( '<input>', $inp );

    }


    public function testLabel() : void {
        $lab = new Elements\Label( $this->doc );
        $lab->setFor( 'foo' );
        self::assertEquals( '<label for="foo"></label>', $lab );
    }


    public function testLegend() : void {
        $legend = new Elements\Legend( $this->doc, 'test' );
        self::assertEquals( '<legend>test</legend>', strval( $legend ) );
    }


    public function testLink() : void {
        $lnk = new Elements\Link( $this->doc, 'foo', 'stylesheet', 'text/css' );
        $lnk->setSizes( 'bar' );
        /** @noinspection HtmlUnknownTarget */
        self::assertEquals( '<link href="foo" rel="stylesheet" sizes="bar" type="text/css">', $lnk );
    }


    public function testMeta() : void {
        $mta = new Elements\Meta( $this->doc );
        $mta->setCharset( 'UTF-8' );
        $mta->setContent( 'foo' );
        $mta->setName( 'bar' );
        self::assertEquals( '<meta charset="UTF-8" content="foo" name="bar">', $mta );
    }


    public function testOption() : void {
        $opt = new Elements\Option( $this->doc );
        $opt->setValue( 'foo' );
        self::assertEquals( '<option value="foo"></option>', $opt );
    }


    public function testScript() : void {
        $scr = new Elements\Script( $this->doc );
        $scr->setSrc( 'foo' );
        /** @noinspection HtmlUnknownTarget */
        self::assertEquals( '<script src="foo"></script>', $scr );
    }


    public function testSimpleElements() : void {
        $this->checkSimpleElement( new Elements\Article( $this->doc ), 'article' );
        $this->checkSimpleElement( new Elements\Aside( $this->doc ), 'aside' );
        $this->checkSimpleUnclosed( new Elements\Br( $this->doc ), 'br' );
        $this->checkSimpleElement( new Elements\Button( $this->doc ), 'button' );
        $this->checkSimpleContainsFoo( new Elements\Dd( $this->doc, 'foo' ), 'dd' );
        $this->checkSimpleContainsFoo( new Elements\Div( $this->doc, 'foo' ), 'div' );
        $this->checkSimpleElement( new Elements\Dl( $this->doc ), 'dl' );
        $this->checkSimpleContainsFoo( new Elements\Dt( $this->doc, 'foo' ), 'dt' );
        $this->checkSimpleElement( new Elements\Footer( $this->doc ), 'footer' );
        $this->checkSimpleElement( new Elements\H1( $this->doc ), 'h1' );
        $this->checkSimpleElement( new Elements\H2( $this->doc ), 'h2' );
        $this->checkSimpleElement( new Elements\H3( $this->doc ), 'h3' );
        $this->checkSimpleElement( new Elements\H4( $this->doc ), 'h4' );
        $this->checkSimpleElement( new Elements\H5( $this->doc ), 'h5' );
        $this->checkSimpleElement( new Elements\H6( $this->doc ), 'h6' );
        $this->checkSimpleElement( new Elements\Header( $this->doc ), 'header' );
        $this->checkSimpleElement( new Elements\Li( $this->doc ), 'li' );
        $this->checkSimpleElement( new Elements\Main( $this->doc ), 'main' );
        $this->checkSimpleElement( new Elements\Nav( $this->doc ), 'nav' );
        $this->checkSimpleElement( new Elements\Ol( $this->doc ), 'ol' );
        $this->checkSimpleElement( new Elements\Section( $this->doc ), 'section' );
        $this->checkSimpleElement( new Elements\Select( $this->doc ), 'select' );
        $this->checkSimpleElement( new Elements\Span( $this->doc ), 'span' );
        $this->checkSimpleElement( new Elements\Ul( $this->doc ), 'ul' );
    }


    public function testStyle() : void {
        $sty = new Elements\Style( $this->doc );
        self::assertEquals( '<style></style>', $sty );
    }


    public function testTextArea() : void {
        $txt = new Elements\TextArea( $this->doc );
        $txt->setCols( 3 );
        $txt->setName( 'foo' );
        $txt->setPlaceHolder( 'bar' );
        $txt->setRows( 7 );
        self::assertEquals( '<textarea cols="3" name="foo" placeholder="bar" rows="7"></textarea>', $txt );
    }


    private function checkSimpleContainsFoo( IElement $i_element, string $i_name, string $i_foo = 'foo' ) : void {
        self::assertEquals( "<{$i_name}>{$i_foo}</{$i_name}>", $i_element );
    }


    private function checkSimpleElement( IElement $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}></{$i_name}>", $i_element );
    }


    private function checkSimpleUnclosed( IElement $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}>", $i_element );
    }


}

