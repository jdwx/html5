<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\UnclosedHtmlElement;


class Img extends UnclosedHtmlElement {


    protected const string TAG_NAME = 'img';


    public function addAlt( bool|string ...$values ) : static {
        return $this->addAttribute( 'alt', ...$values );
    }


    public function addSrc( bool|string ...$values ) : static {
        return $this->addAttribute( 'src', ...$values );
    }


    public function alt( string|false|null $value ) : static {
        return $this->setAlt( $value ?? false );
    }


    public function getAlt() : bool|string|null {
        return $this->getAttribute( 'alt' );
    }


    public function getSrc() : bool|string|null {
        return $this->getAttribute( 'src' );
    }


    public function hasAlt( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'alt', $value );
    }


    public function hasSrc( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'src', $value );
    }


    public function setAlt( bool|string ...$values ) : static {
        return $this->setAttribute( 'alt', ...$values );
    }


    public function setSrc( bool|string ...$values ) : static {
        return $this->setAttribute( 'src', ...$values );
    }


    public function src( string|false|null $value ) : static {
        return $this->setSrc( $value ?? false );
    }


}
