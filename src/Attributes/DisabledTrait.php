<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait DisabledTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addDisabled( bool|string ...$values ) : static {
        return $this->addAttribute( 'disabled', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function disabled( ?bool $value = true ) : static {
        return $this->setDisabled( $value ?? false );
    }


    public function getDisabled() : string|true|null {
        return $this->getAttribute( 'disabled' );
    }


    public function hasDisabled( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'disabled', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setDisabled( bool|string ...$values ) : static {
        return $this->setAttribute( 'disabled', ...$values );
    }


}
