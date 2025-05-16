<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Elements\Title;
use Stringable;
use tidy;


class Document extends AbstractDocument {


    protected string $stDocType = 'html';

    protected Elements\Html $elHTML;

    protected Elements\Head $elHead;

    protected Elements\Body $elBody;


    public function __construct( string $i_stCharset = 'UTF-8' ) {
        parent::__construct( $i_stCharset );
        $this->elHead = ElementFactory::head();
        $this->elBody = ElementFactory::body();
        $this->elHTML = ElementFactory::html( [ $this->elHead, $this->elBody ] );

        ElementFactory::meta()->charset( $i_stCharset )->withParent( $this->elHead );
    }


    public function __toString() : string {
        $st = '<!DOCTYPE ' . $this->stDocType . '>';
        return $st . $this->elHTML;
    }


    public function addCSSFile( string $i_stHref ) : void {
        ElementFactory::link()->rel( 'stylesheet' )->type( 'text/css' )
            ->href( $i_stHref )->withParent( $this->elHead );
    }


    /** @suppress PhanNoopNew */
    public function addIconFile( string $i_stHref,
                                 string $i_stType = 'image/vnd.microsoft.icon' ) : void {
        ElementFactory::link()->href( $i_stHref )->rel( 'icon' )->type( $i_stType )->withParent( $this->elHead );
    }


    /**
     * @param iterable<string|Stringable>|Stringable|string ...$i_rxChildren
     * @noinspection PhpDocSignatureInspection
     */
    public function append( ...$i_rxChildren ) : void {
        $this->appendToBody( ... $i_rxChildren );
    }


    /**
     * @param iterable<Element|string>|IElement|string ...$i_rxChildren
     * @noinspection PhpDocSignatureInspection
     */
    public function appendToBody( ...$i_rxChildren ) : void {
        foreach ( $i_rxChildren as $xChild ) {
            if ( $xChild instanceof Element ) {
                $xChild->withParent( $this->elBody );
            } else {
                $this->elBody->appendChild( $xChild );
            }
        }
    }


    public function appendToTitle( string $i_stTitle ) : void {
        $elTitle = $this->elHead->nthChildElementByTagName( 'title' );
        if ( $elTitle instanceof Element ) {
            $elTitle->appendChild( $i_stTitle );
        } else {
            $this->setTitle( $i_stTitle );
        }
    }


    public function body() : Elements\Body {
        return $this->elBody;
    }


    public function head() : Elements\Head {
        return $this->elHead;
    }


    /** @suppress PhanNoopNew */
    public function setTitle( string $i_stTitle ) : void {
        $title = $this->elHead->nthChildElementByTagName( 'title' );
        if ( $title instanceof Title ) {
            $title->removeAllChildren();
            $title->appendChild( $i_stTitle );
        } else {
            ElementFactory::title( $i_stTitle )->withParent( $this->elHead );
        }
    }


    public function tidy() : string {
        $htm = ( string ) $this;
        $cfgTidy = [
            'drop-empty-paras' => false,
            'indent' => true,
            'merge-divs' => false,
            'merge-spans' => false,
            'output-html' => true,
            'output-xml' => false,
            'preserve-entities' => true,
            'input-xml' => false,
            'wrap' => 100,
        ];
        $tidy = new tidy();
        $tidy->parseString( $htm, $cfgTidy, 'utf8' );
        return tidy_get_output( $tidy );
    }


}


