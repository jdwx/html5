<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait AriaLabelTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addAriaLabel( string|true ...$values ) : static {
        return $this->addAttribute( 'aria-label', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function ariaLabel( false|string|null $value ) : static {
        return $this->setAriaLabel( $value ?? false );
    }


    public function getAriaLabel() : string|true|null {
        return $this->getAttribute( 'aria-label' );
    }


    public function hasAriaLabel( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'aria-label', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAriaLabel( bool|string ...$values ) : static {
        return $this->setAttribute( 'aria-label', ...$values );
    }


}
