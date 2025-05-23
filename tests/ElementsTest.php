<?php /** @noinspection HtmlUnknownTarget */


declare( strict_types = 1 );


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/MyTestCase.php';


use JDWX\HTML5\Element;
use JDWX\HTML5\ElementFactory;
use JDWX\HTML5\Elements;


class ElementsTest extends MyTestCase {


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
        $this->runAttributeBoolTest( Elements\Input::class, 'formNoValidate' );
        $this->runAttributeIntTest( Elements\Input::class, 'max' );
        $this->runAttributeIntTest( Elements\Input::class, 'maxlength' );
        $this->runAttributeIntTest( Elements\Input::class, 'min' );
        $this->runAttributeStringTest( Elements\Input::class, 'name' );
        $this->runAttributeStringTest( Elements\Input::class, 'pattern' );
        $this->runAttributeIntTest( Elements\Input::class, 'size' );
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
        $this->runAttributeBoolTest( Elements\Option::class, 'selected' );
    }


    public function testScript() : void {
        $scr = ( new Elements\Script() )->src( 'foo' );
        self::assertEquals( '<script src="foo"></script>', $scr );
    }


    public function testSelect() : void {
        $this->runChildTest( Elements\Select::class, Elements\Option::class );
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


    private function checkSimpleContainsFoo( Element $i_element, string $i_name, string $i_foo = 'foo' ) : void {
        self::assertEquals( "<{$i_name}>{$i_foo}</{$i_name}>", strval( $i_element ) );
    }


    private function checkSimpleElement( Element $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}></{$i_name}>", strval( $i_element ) );
    }


    private function checkSimpleUnclosed( Element $i_element, string $i_name ) : void {
        self::assertEquals( "<{$i_name}>", strval( $i_element ) );
    }


    private function runAttributeBoolTest( string $i_stClass, string $i_stAttribute ) : void {
        $this->runAttributeTest( $i_stClass, $i_stAttribute, [
            [ true, true ],
            [ false, null ],
        ] );
    }


    private function runAttributeIntTest( string $i_stClass, string $i_stAttribute ) : void {
        $this->runAttributeTest( $i_stClass, $i_stAttribute, [ [ 1, '1' ], [ false, null ] ] );
    }


    private function runAttributeStringTest( string $i_stClass, string $i_stAttribute ) : void {
        $this->runAttributeTest( $i_stClass, $i_stAttribute, [ [ 'foo', 'foo' ] ] );
    }


    /** @param list<list<mixed>> $i_rBareChecks */
    private function runAttributeTest( string $i_stClass, string $i_stAttribute, array $i_rBareChecks ) : void {
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
        self::assertSame( 'Foo Bar Baz', $fnGet() );

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

