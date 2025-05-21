<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\UnclosedElement;


class Img extends UnclosedElement {


    protected const string TAG_NAME = 'img';


    public function addAlt( string|true ...$values ) : static {
        return $this->addAttribute( 'alt', ...$values );
    }


    public function addSrc( string|true ...$values ) : static {
        return $this->addAttribute( 'src', ...$values );
    }


    public function alt( false|string|null $value ) : static {
        return $this->setAlt( $value ?? false );
    }


    public function getAlt() : string|true|null {
        return $this->getAttribute( 'alt' );
    }


    public function getSrc() : string|true|null {
        return $this->getAttribute( 'src' );
    }


    public function hasAlt( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'alt', $value );
    }


    public function hasSrc( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'src', $value );
    }


    public function setAlt( bool|string ...$values ) : static {
        return $this->setAttribute( 'alt', ...$values );
    }


    public function setSrc( bool|string ...$values ) : static {
        return $this->setAttribute( 'src', ...$values );
    }


    public function src( false|string|null $value ) : static {
        return $this->setSrc( $value ?? false );
    }


}
