<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait AriaLabelTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addAriaLabel( bool|string ...$values ) : static {
        return $this->addAttribute( 'aria-label', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function ariaLabel( string|false|null $value ) : static {
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
