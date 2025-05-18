<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait StyleTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addStyle( bool|string ...$values ) : static {
        return $this->addAttribute( 'style', ...$values );
    }


    public function getStyle() : string|true|null {
        return $this->getAttribute( 'style' );
    }


    public function hasStyle( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'style', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setStyle( bool|string ...$values ) : static {
        return $this->setAttribute( 'style', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function style( string|false|null $value ) : static {
        return $this->addStyle( $value ?? false );
    }


}