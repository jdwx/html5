<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait AriaHiddenTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addAriaHidden( string|true ...$values ) : static {
        return $this->addAttribute( 'aria-hidden', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function ariaHidden( ?bool $value ) : static {
        return $this->setAriaHidden( is_bool( $value ) ? ( $value ? 'true' : false ) : false );
    }


    public function getAriaHidden() : string|true|null {
        return $this->getAttribute( 'aria-hidden' );
    }


    public function hasAriaHidden( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'aria-hidden', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAriaHidden( bool|string ...$values ) : static {
        return $this->setAttribute( 'aria-hidden', ...$values );
    }


}
