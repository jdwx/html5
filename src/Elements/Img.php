<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\UnclosedElement;


class Img extends UnclosedElement {


    protected const string TAG_NAME = 'img';


    public function addAlt( string|true ...$values ) : static {
        return $this->addAttribute( 'alt', ...$values );
    }


    public function addHeight( string|true ...$values ) : static {
        return $this->addAttribute( 'height', ...$values );
    }


    public function addSrc( string|true ...$values ) : static {
        return $this->addAttribute( 'src', ...$values );
    }


    public function addWidth( string|true ...$values ) : static {
        return $this->addAttribute( 'width', ...$values );
    }


    public function alt( false|string|null $value ) : static {
        return $this->setAlt( $value ?? false );
    }


    public function getAlt() : string|true|null {
        return $this->getAttribute( 'alt' );
    }


    public function getHeight() : string|true|null {
        return $this->getAttribute( 'height' );
    }


    public function getSrc() : string|true|null {
        return $this->getAttribute( 'src' );
    }


    public function getWidth() : string|true|null {
        return $this->getAttribute( 'width' );
    }


    public function hasAlt( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'alt', $value );
    }


    public function hasHeight( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'height', $value );
    }


    public function hasSrc( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'src', $value );
    }


    public function hasWidth( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'width', $value );
    }


    public function height( false|int|null $value ) : static {
        return $this->setHeight( is_int( $value ) ? strval( $value ) : false );
    }


    public function setAlt( bool|string ...$values ) : static {
        return $this->setAttribute( 'alt', ...$values );
    }


    public function setHeight( bool|string ...$values ) : static {
        return $this->setAttribute( 'height', ...$values );
    }


    public function setSrc( bool|string ...$values ) : static {
        return $this->setAttribute( 'src', ...$values );
    }


    public function setWidth( bool|string ...$values ) : static {
        return $this->setAttribute( 'width', ...$values );
    }


    public function src( false|string|null $value ) : static {
        return $this->setSrc( $value ?? false );
    }


    public function width( false|int|null $value ) : static {
        return $this->setWidth( is_int( $value ) ? strval( $value ) : false );
    }


}
