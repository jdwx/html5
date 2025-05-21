<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait NameTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addName( string|true ...$values ) : static {
        return $this->addAttribute( 'name', ...$values );
    }


    public function getName() : string|true|null {
        return $this->getAttribute( 'name' );
    }


    public function hasName( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'name', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function name( false|string|null $value ) : static {
        return $this->setName( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setName( bool|string ...$values ) : static {
        return $this->setAttribute( 'name', ...$values );
    }


}
