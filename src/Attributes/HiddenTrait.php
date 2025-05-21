<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait HiddenTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addHidden( string|true ...$values ) : static {
        return $this->addAttribute( 'hidden', ...$values );
    }


    public function getHidden() : string|true|null {
        return $this->getAttribute( 'hidden' );
    }


    public function hasHidden( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'hidden', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function hidden( ?bool $value = true ) : static {
        return $this->setHidden( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setHidden( bool|string ...$values ) : static {
        return $this->setAttribute( 'hidden', ...$values );
    }


}
