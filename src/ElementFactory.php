<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Elements\Anchor;
use JDWX\HTML5\Elements\Body;
use JDWX\HTML5\Elements\Div;
use JDWX\HTML5\Elements\Footer;
use JDWX\HTML5\Elements\Form;
use JDWX\HTML5\Elements\Head;
use JDWX\HTML5\Elements\Header;
use JDWX\HTML5\Elements\HTML;
use JDWX\HTML5\Elements\Input;
use JDWX\HTML5\Elements\Label;
use JDWX\HTML5\Elements\Li;
use JDWX\HTML5\Elements\Link;
use JDWX\HTML5\Elements\ListElement;
use JDWX\HTML5\Elements\Meta;
use JDWX\HTML5\Elements\Nav;
use JDWX\HTML5\Elements\Ol;
use JDWX\HTML5\Elements\Paragraph;
use JDWX\HTML5\Elements\Span;
use JDWX\HTML5\Elements\Table;
use JDWX\HTML5\Elements\TBodyFootHead;
use JDWX\HTML5\Elements\TdTh;
use JDWX\HTML5\Elements\Title;
use JDWX\HTML5\Elements\Tr;
use Stringable;


class ElementFactory {


    public static function a( string|Stringable|array $i_children = [] ) : Anchor {
        return new Anchor( $i_children );
    }


    public static function body( string|Stringable|array $i_children = [] ) : Body {
        return new Body( $i_children );
    }


    public static function div( string|Stringable|array $i_children = [] ) : Div {
        return new Div( $i_children );
    }


    public static function footer( string|Stringable|array $i_children = [] ) : Footer {
        return new Footer( $i_children );
    }


    public static function form( string|Stringable|array $i_children = [] ) : Form {
        return new Form( $i_children );
    }


    public static function head( string|Stringable|array $i_children = [] ) : Head {
        return new Head( $i_children );
    }


    public static function header( string|Stringable|array $i_children = [] ) : Header {
        return new Header( $i_children );
    }


    public static function html( string|Stringable|array $i_children = [] ) : HTML {
        return new HTML( $i_children );
    }


    public static function input( string|Stringable|array $i_children = [] ) : Input {
        return new Input( $i_children );
    }


    public static function label( string|Stringable|array $i_children = [] ) : Label {
        return new Label( $i_children );
    }


    public static function li( string|Stringable|array $i_children = [] ) : Li {
        return new Li( $i_children );
    }


    public static function link( string|Stringable|array $i_children = [] ) : Link {
        return new Link( $i_children );
    }


    public static function make( string            $i_strType,
                                 string|Stringable ...$i_rxChildren ) : Anchor|Tr|TdTh|Table|TBodyFootHead|Element {

        return match ( $i_strType ) {
            'a' => self::a( $i_rxChildren ),
            'table' => self::table( $i_rxChildren ),
            'tbody' => self::tbody( $i_rxChildren ),
            'td' => self::td( $i_rxChildren ),
            'tfoot' => self::tfoot( $i_rxChildren ),
            'th' => self::th( $i_rxChildren ),
            'thead' => self::thead( $i_rxChildren ),
            'tr' => self::tr( $i_rxChildren ),
            default => new Element( $i_strType, $i_rxChildren ),
        };

    }


    public static function meta( string|Stringable|array $i_children = [] ) : Meta {
        return new Meta( $i_children );
    }


    public static function nav( string|Stringable|array $i_children = [] ) : Nav {
        return new Nav( $i_children );
    }


    public static function ol( string|Stringable|array $i_children = [] ) : Ol {
        return new Ol( $i_children );
    }


    public static function p( string|Stringable|array $i_children = [] ) : Paragraph {
        return new Paragraph( $i_children );
    }


    public static function span( string|Stringable|array $i_children = [] ) : Span {
        return new Span( $i_children );
    }


    public static function table( string|Stringable|array $i_children = [] ) : Table {
        return new Table( $i_children );
    }


    public static function tbody( string|Stringable|array $i_children = [] ) : TBodyFootHead {
        return new TBodyFootHead( 'tbody', $i_children );
    }


    public static function td( string|Stringable|array $i_children = [] ) : TdTh {
        return new TdTh( 'td', $i_children );
    }


    public static function tfoot( string|Stringable|array $i_children = [] ) : TBodyFootHead {
        return new TBodyFootHead( 'tfoot', $i_children );
    }


    public static function th( string|Stringable|array $i_children = [] ) : TdTh {
        return new TdTh( 'th', $i_children );
    }


    public static function thead( string|Stringable|array $i_children = [] ) : TBodyFootHead {
        return new TBodyFootHead( 'thead', $i_children );
    }


    public static function title( string|Stringable|array $i_children = [] ) : Title {
        return new Title( $i_children );
    }


    public static function tr( string|Stringable|array $i_children = [] ) : Tr {
        return new Tr( $i_children );
    }


    public static function ul( string|Stringable|array $i_children = [] ) : ListElement {
        return new ListElement( 'ul', $i_children );
    }


}
