<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait RequiredTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addRequired( string|true ...$values ) : static {
        return $this->addAttribute( 'required', ...$values );
    }


    public function getRequired() : string|true|null {
        return $this->getAttribute( 'required' );
    }


    public function hasRequired( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'required', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function required( ?bool $value ) : static {
        return $this->setRequired( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setRequired( bool|string ...$values ) : static {
        return $this->setAttribute( 'required', ...$values );
    }


}
