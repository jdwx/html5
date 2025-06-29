<?php /** @noinspection HtmlUnknownTarget */


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Shims/MyTestCase.php';


use JDWX\HTML5\Element;
use JDWX\HTML5\ElementInterface;
use JDWX\HTML5\Elements;
use JDWX\HTML5\Tests\Shims\MyTestCase;
use JDWX\HTML5\UnclosedElement;


class ElementsTest extends MyTestCase {


    public function runRenderTest( string $i_stClass ) : void {
        $el = new $i_stClass();
        assert( $el instanceof ElementInterface );
        $stTag = $el->getTagName();
        if ( $el instanceof UnclosedElement ) {
            self::assertSame( "<{$stTag}>", strval( $el ) );
        } else {
            self::assertSame( "<{$stTag}></{$stTag}>", strval( $el ) );
        }
    }


    public function testAnchor() : void {
        $this->runAttributeBoolTest( Elements\Anchor::class, 'download' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'href' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'hreflang' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'media' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'ping' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'rel' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'target' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'title' );
    }


    public function testAriaAttributes() : void {
        $this->runAttributeBoolTest( Elements\Anchor::class, 'ariaHidden', 'true' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'ariaLabel' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'role' );
    }


    public function testBlockQuote() : void {
        $this->runAttributeStringTest( Elements\Blockquote::class, 'cite' );
    }


    public function testDetails() : void {
        $this->runAttributeBoolTest( Elements\Details::class, 'open' );
        $this->runChildTest( Elements\Details::class, Elements\Summary::class );
    }


    public function testDiv() : void {
        $this->runAttributeStringTest( Elements\Div::class, 'onclick' );
    }


    public function testDl() : void {
        $this->runChildTest( Elements\Dl::class, Elements\Dd::class );
        $this->runChildTest( Elements\Dl::class, Elements\Dt::class );
    }


    public function testFieldset() : void {
        $this->runChildTest( Elements\Fieldset::class, Elements\Legend::class );
    }


    public function testForm() : void {
        $this->runAttributeStringTest( Elements\Form::class, 'action' );
        $this->runAttributeStringTest( Elements\Form::class, 'enctype' );
        $this->runAttributeStringTest( Elements\Form::class, 'method' );
    }


    /**
     * We'll stuff a lot of tests of global attributes here.
     */
    public function testGlobalAttributes() : void {
        $this->runAttributeStringTest( Elements\Anchor::class, 'accesskey' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'autocapitalize' );
        $this->runAttributeBoolTest( Elements\Anchor::class, 'autocorrect', true, 'off' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'class' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'contenteditable' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'dir' );
        $this->runAttributeBoolTest( Elements\Anchor::class, 'draggable', 'true', 'false' );
        $this->runAttributeBoolTest( Elements\Anchor::class, 'hidden' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'id' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'lang' );
        $this->runAttributeTest( Elements\Anchor::class, 'spellcheck', [
            [ true, 'true' ],
            [ false, 'false' ],
        ] );
        $this->runAttributeStringTest( Elements\Anchor::class, 'style', 'Foo Bar; Baz;' );
        $this->runAttributeIntTest( Elements\Anchor::class, 'tabindex' );
        $this->runAttributeStringTest( Elements\Anchor::class, 'title' );
        $this->runAttributeBoolTest( Elements\Anchor::class, 'translate', true, 'no' );
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
        $this->runAttributeStringTest( Elements\Img::class, 'alt' );
        $this->runAttributeIntTest( Elements\Img::class, 'height' );
        $this->runAttributeStringTest( Elements\Img::class, 'src' );
        $this->runAttributeIntTest( Elements\Img::class, 'width' );
    }


    public function testInput() : void {
        $this->runAttributeStringTest( Elements\Input::class, 'autocomplete' );
        $this->runAttributeBoolTest( Elements\Input::class, 'autofocus' );
        $this->runAttributeBoolTest( Elements\Input::class, 'checked' );
        $this->runAttributeStringTest( Elements\Input::class, 'form' );
        $this->runAttributeBoolTest( Elements\Input::class, 'formNoValidate' );
        $this->runAttributeIntTest( Elements\Input::class, 'max' );
        $this->runAttributeIntTest( Elements\Input::class, 'maxlength' );
        $this->runAttributeIntTest( Elements\Input::class, 'min' );
        $this->runAttributeStringTest( Elements\Input::class, 'name' );
        $this->runAttributeStringTest( Elements\Input::class, 'pattern' );
        $this->runAttributeStringTest( Elements\Input::class, 'placeholder' );
        $this->runAttributeIntTest( Elements\Input::class, 'size' );
        $this->runAttributeTest( Elements\Input::class, 'step', [
            [ 'any', 'any' ], [ 2, '2' ], [ 2.1, '2.1' ],
        ] );
        $this->runAttributeStringTest( Elements\Input::class, 'type' );
        $this->runAttributeStringTest( Elements\Input::class, 'value' );
    }


    public function testLabel() : void {
        $this->runAttributeStringTest( Elements\Label::class, 'for' );
    }


    public function testLegend() : void {
        $legend = new Elements\Legend( 'test' );
        self::assertEquals( '<legend>test</legend>', strval( $legend ) );
    }


    public function testLink() : void {
        $this->runRenderTest( Elements\Link::class );
        $lnk = ( new Elements\Link() )->href( 'foo' )->rel( 'stylesheet' )
            ->sizes( 'bar' )->type( 'text/css' );
        /** @noinspection HtmlUnknownTarget */
        self::assertEquals( '<link href="foo" rel="stylesheet" sizes="bar" type="text/css">', strval( $lnk ) );
    }


    public function testMeta() : void {
        $this->runAttributeStringTest( Elements\Meta::class, 'charset' );
        $this->runAttributeStringTest( Elements\Meta::class, 'content' );
        $this->runAttributeStringTest( Elements\Meta::class, 'httpEquiv' );
        $this->runRenderTest( Elements\Meta::class );
    }


    public function testOl() : void {
        $this->runChildTest( Elements\Ol::class, Elements\Li::class );
        $this->runAttributeBoolTest( Elements\Ol::class, 'reversed' );
        $this->runAttributeStringTest( Elements\Ol::class, 'start' );
    }


    public function testOption() : void {
        $this->runRenderTest( Elements\Option::class );
        $opt = new Elements\Option( 'Foo' );
        $opt->value( 'foo' );
        self::assertEquals( '<option value="foo">Foo</option>', $opt );
        $this->runAttributeBoolTest( Elements\Option::class, 'selected' );
    }


    public function testScript() : void {
        $scr = ( new Elements\Script() )->src( 'foo' );
        self::assertEquals( '<script src="foo"></script>', $scr );
    }


    public function testSelect() : void {
        $this->runChildTest( Elements\Select::class, Elements\Option::class );
        $this->runAttributeBoolTest( Elements\Select::class, 'disabled' );
        $this->runAttributeBoolTest( Elements\Select::class, 'multiple' );
        $this->runAttributeBoolTest( Elements\Select::class, 'required' );
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
        $this->checkSimpleElement( new Elements\Summary(), 'summary' );
        $this->checkSimpleElement( new Elements\Ul(), 'ul' );
    }


    public function testStyle() : void {
        $sty = new Elements\Style( '.foo' );
        self::assertEquals( '<style>.foo</style>', $sty );
    }


    public function testTable() : void {
        $this->runChildTest( Elements\Table::class, Elements\TableBody::class );
        $this->runChildTest( Elements\Table::class, Elements\TableHead::class );
        $this->runChildTest( Elements\Table::class, Elements\TableFoot::class );
    }


    public function testTableBody() : void {
        $this->runChildTest( Elements\TableBody::class, Elements\Tr::class );
    }


    public function testTd() : void {
        $this->runRenderTest( Elements\Td::class );
        $this->runAttributeIntTest( Elements\Td::class, 'colspan' );
        $this->runAttributeIntTest( Elements\Td::class, 'rowspan' );
    }


    public function testTextArea() : void {
        $txt = ( new Elements\TextArea() )->cols( 3 )->name( 'foo' )->rows( 7 )->placeholder( 'bar' );
        self::assertEquals( '<textarea cols="3" name="foo" placeholder="bar" rows="7"></textarea>', $txt );
    }


    public function testTr() : void {
        $this->runRenderTest( Elements\Tr::class );
        $this->runChildTest( Elements\Tr::class, Elements\Th::class );
        $this->runChildTest( Elements\Tr::class, Elements\Td::class );
        $tr = new Elements\Tr();
        $tr->tds( 'foo', 'bar', null, 'baz' );
        self::assertSame( '<tr><td>foo</td><td>bar</td><td></td><td>baz</td></tr>', strval( $tr ) );

        $tr = new Elements\Tr();
        $tr->ths( 'foo', 'bar', null, 'baz' );
        self::assertSame( '<tr><th>foo</th><th>bar</th><th></th><th>baz</th></tr>', strval( $tr ) );

    }


    private function checkSimpleContainsFoo( Element $i_element, string $i_name, string $i_foo = 'foo' ) : void {
        self::assertEquals( "<{$i_name}>{$i_foo}</{$i_name}>", strval( $i_element ) );
    }


    private function checkSimpleElement( Element $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}></{$i_name}>", strval( $i_element ) );
    }


    private function checkSimpleUnclosed( Element $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}>", strval( $i_element ) );
    }


    private function runAttributeBoolTest( string $i_stClass, string $i_stAttribute, mixed $i_true = true,
                                           mixed  $i_false = null ) : void {
        $this->runAttributeTest( $i_stClass, $i_stAttribute, [
            [ true, $i_true ],
            [ false, $i_false ],
        ] );
    }


    private function runAttributeIntTest( string $i_stClass, string $i_stAttribute ) : void {
        $this->runAttributeTest( $i_stClass, $i_stAttribute, [ [ 1, '1' ], [ false, null ] ] );
    }


    private function runAttributeStringTest( string  $i_stClass, string $i_stAttribute,
                                             ?string $i_nstGet = null ) : void {
        $this->runAttributeTest( $i_stClass, $i_stAttribute, [ [ 'foo', 'foo' ] ], $i_nstGet );
    }


    /** @param list<list<mixed>> $i_rBareChecks */
    private function runAttributeTest( string  $i_stClass, string $i_stAttribute, array $i_rBareChecks,
                                       ?string $i_nstGet = null ) : void {
        $el = new $i_stClass();
        $fnAdd = [ $el, "add{$i_stAttribute}" ];
        $fnGet = [ $el, "get{$i_stAttribute}" ];
        $fnHas = [ $el, "has{$i_stAttribute}" ];
        $fnSet = [ $el, "set{$i_stAttribute}" ];
        $fnBare = [ $el, lcfirst( $i_stAttribute ) ];

        self::assertFalse( $fnHas() );
        $fnSet( 'Foo', 'Bar' );
        $fnAdd( 'Baz' );
        self::assertTrue( $fnHas() );
        self::assertTrue( $fnHas( 'Foo' ) );
        $i_nstGet = $i_nstGet ?? 'Foo Bar Baz';
        self::assertSame( $i_nstGet, $fnGet() );

        foreach ( $i_rBareChecks as $row ) {
            [ $stWrite, $stCheck ] = $row;
            $fnSet( false );
            $fnBare( $stWrite );
            self::assertSame( $stCheck, $fnGet() );
        }

    }


    private function runChildTest( string $i_stClass, string $i_stChild ) : void {
        $el = new $i_stClass();
        $cls = new $i_stChild();
        $fnChild = [ $el, $cls->getTagName() ];
        $child = $fnChild( 'foo' );
        self::assertInstanceOf( $i_stChild, $child );
    }


}

