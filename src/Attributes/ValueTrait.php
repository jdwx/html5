<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait ValueTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addValue( string|true ...$values ) : static {
        return $this->addAttribute( 'value', ...$values );
    }


    public function getValue() : string|true|null {
        return $this->getAttribute( 'value' );
    }


    public function hasValue( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'value', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setValue( bool|string ...$values ) : static {
        return $this->setAttribute( 'value', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function value( false|string|null $value ) : static {
        return $this->setValue( $value ?? false );
    }


}
