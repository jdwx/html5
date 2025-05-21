<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait ClassTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addClass( string|true ...$values ) : static {
        return $this->addAttribute( 'class', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function class( false|string|null ...$values ) : static {
        return $this->addAttributeFromBare( 'class', ...$values );
    }


    public function getClass() : string|true|null {
        return $this->getAttribute( 'class' );
    }


    public function hasClass( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'class', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setClass( bool|string ...$values ) : static {
        return $this->setAttribute( 'class', ...$values );
    }


}
