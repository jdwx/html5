<?php /** @noinspection HtmlUnknownTarget */


declare( strict_types = 1 );


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/MyTestCase.php';


use JDWX\HTML5\ElementFactory;
use JDWX\HTML5\Elements;
use JDWX\HTML5\HtmlElement;


class ElementsTest extends MyTestCase {


    /** @noinspection PhpConditionAlreadyCheckedInspection */
    public function testAnchor() : void {

        $a = new Elements\Anchor();
        $a->download( true );
        self::assertEquals( '<a download></a>', $a );
        $a->download( 'baz' );
        self::assertEquals( '<a download="baz"></a>', $a );
        $a->download( false );
        self::assertEquals( '<a></a>', $a );

        $a->ping( 'ping' );
        $a->ping( 'pong' );
        $a->rel( 'foo' );
        $a->rel( 'bar' );
        $a->media( 'nope' );
        $a->media( 'qux' );
        $a->hrefLang( 'nope' );
        $a->hrefLang( 'en-US' );
        $a->target( 'nope' );
        $a->target( '_blank' );
        /** @noinspection HtmlUnknownAttribute */
        self::assertEquals( '<a hreflang="en-US" media="qux" ping="ping pong" rel="foo bar" target="_blank"></a>', $a );

    }


    public function testFieldset() : void {
        $fld = new Elements\Fieldset();
        $fld->setDisabled( true );
        $fld->setForm( 'foo' );
        $fld->setName( 'bar' );
        self::assertEquals( '<fieldset disabled form="foo" name="bar"></fieldset>', $fld );
    }


    /** @noinspection HtmlUnknownTarget */
    public function testForm() : void {
        $frm = ( new Elements\Form() )->action( 'foo' )->method( 'POST' );
        $frm->setEncType( 'multipart/form-data' );
        self::assertEquals( '<form action="foo" enctype="multipart/form-data" method="POST"></form>', $frm );
    }


    public function testHr() : void {
        $hr = new Elements\Hr();
        self::assertFalse( $hr->getAlwaysClose() );
        self::assertEquals( 0, $hr->countChildren() );
        self::assertFalse( $hr->hasChildren() );
        self::assertEquals( '<hr>', $hr );
    }


    public function testHtml() : void {
        $html = new Elements\Html();
        $html->setLang( 'en' );
        self::assertEquals( '<html lang="en"></html>', $html );
    }


    public function testImg() : void {
        $img = ( new Elements\Img() )->alt( 'foo' )->src( 'bar' );
        self::assertEquals( '<img alt="foo" src="bar">', $img );
    }


    /** @noinspection PhpConditionAlreadyCheckedInspection */
    public function testInput() : void {
        $inp = ( new Elements\Input() )->name( 'foo' )->type( 'text' )->value( 'bar' )
            ->size( 20 )->maxLength( 30 )->setPlaceHolder( 'baz' );
        self::assertEquals( '<input maxlength="30" name="foo" placeholder="baz" size="20" type="text" value="bar">',
            $inp );

        $inp->value( null );
        self::assertEquals( '<input maxlength="30" name="foo" placeholder="baz" size="20" type="text">', $inp );

        $inp = new Elements\Input();
        self::assertEquals( '<input>', strval( $inp ) );
        $inp->setChecked( true );
        self::assertEquals( '<input checked>', $inp );
        $inp->setChecked( false );
        self::assertEquals( '<input>', $inp );

        $inp = new Elements\Input();
        $inp->setPattern( '[0-9]{5}' );
        self::assertEquals( '<input pattern="[0-9]{5}">', $inp );
        $inp->pattern( null );
        self::assertEquals( '<input>', $inp );

        $inp = new Elements\Input();
        $inp->max( 10 );
        self::assertEquals( '<input max="10">', $inp );
        $inp->min( 5 );
        self::assertEquals( '<input max="10" min="5">', $inp );
        $inp->max( null );
        self::assertEquals( '<input min="5">', $inp );
        $inp->min( null );
        self::assertEquals( '<input>', $inp );

    }


    public function testLabel() : void {
        $lab = new Elements\Label();
        $lab->setFor( 'foo' );
        self::assertEquals( '<label for="foo"></label>', $lab );
    }


    public function testLegend() : void {
        $legend = new Elements\Legend( 'test' );
        self::assertEquals( '<legend>test</legend>', strval( $legend ) );
    }


    public function testLink() : void {
        $lnk = ( new Elements\Link() )->href( 'foo' )->rel( 'stylesheet' )
            ->sizes( 'bar' )->type( 'text/css' );
        /** @noinspection HtmlUnknownTarget */
        self::assertEquals( '<link href="foo" rel="stylesheet" sizes="bar" type="text/css">', strval( $lnk ) );
    }


    public function testMeta() : void {
        $mta = ElementFactory::meta();
        $mta->charset( 'UTF-8' );
        $mta->setContent( 'foo' );
        $mta->setName( 'bar' );
        self::assertEquals( '<meta charset="UTF-8" content="foo" name="bar">', strval( $mta ) );
    }


    public function testOption() : void {
        $opt = new Elements\Option( 'Foo' );
        $opt->value( 'foo' );
        self::assertEquals( '<option value="foo">Foo</option>', $opt );
    }


    public function testScript() : void {
        $scr = ( new Elements\Script() )->src( 'foo' );
        self::assertEquals( '<script src="foo"></script>', $scr );
    }


    public function testSimpleElements() : void {
        $this->checkSimpleElement( new Elements\Article(), 'article' );
        $this->checkSimpleElement( new Elements\Aside(), 'aside' );
        $this->checkSimpleUnclosed( new Elements\Br(), 'br' );
        $this->checkSimpleElement( new Elements\Button(), 'button' );
        $this->checkSimpleContainsFoo( new Elements\Dd( 'foo' ), 'dd' );
        $this->checkSimpleContainsFoo( new Elements\Div( 'foo' ), 'div' );
        $this->checkSimpleElement( new Elements\Dl(), 'dl' );
        $this->checkSimpleContainsFoo( new Elements\Dt( 'foo' ), 'dt' );
        $this->checkSimpleElement( new Elements\Footer(), 'footer' );
        $this->checkSimpleElement( new Elements\H1(), 'h1' );
        $this->checkSimpleElement( new Elements\H2(), 'h2' );
        $this->checkSimpleElement( new Elements\H3(), 'h3' );
        $this->checkSimpleElement( new Elements\H4(), 'h4' );
        $this->checkSimpleElement( new Elements\H5(), 'h5' );
        $this->checkSimpleElement( new Elements\H6(), 'h6' );
        $this->checkSimpleElement( new Elements\Header(), 'header' );
        $this->checkSimpleElement( new Elements\Li(), 'li' );
        $this->checkSimpleElement( new Elements\Main(), 'main' );
        $this->checkSimpleElement( new Elements\Nav(), 'nav' );
        $this->checkSimpleElement( new Elements\Ol(), 'ol' );
        $this->checkSimpleElement( new Elements\Section(), 'section' );
        $this->checkSimpleElement( new Elements\Select(), 'select' );
        $this->checkSimpleElement( new Elements\Span(), 'span' );
        $this->checkSimpleElement( new Elements\Ul(), 'ul' );
    }


    public function testStyle() : void {
        $sty = new Elements\Style( '.foo' );
        self::assertEquals( '<style>.foo</style>', $sty );
    }


    public function testTextArea() : void {
        $txt = ( new Elements\TextArea() )->cols( 3 )->name( 'foo' )->rows( 7 )->placeholder( 'bar' );
        self::assertEquals( '<textarea cols="3" name="foo" placeholder="bar" rows="7"></textarea>', $txt );
    }


    private function checkSimpleContainsFoo( HtmlElement $i_element, string $i_name, string $i_foo = 'foo' ) : void {
        self::assertEquals( "<{$i_name}>{$i_foo}</{$i_name}>", strval( $i_element ) );
    }


    private function checkSimpleElement( HtmlElement $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}></{$i_name}>", strval( $i_element ) );
    }


    private function checkSimpleUnclosed( HtmlElement $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}>", strval( $i_element ) );
    }


}

