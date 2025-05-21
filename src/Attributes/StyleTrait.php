<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait StyleTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addStyle( string|true ...$values ) : static {
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
    public function style( false|string|null ...$values ) : static {
        return $this->addAttributeFromBare( 'style', ...$values );
    }


}
