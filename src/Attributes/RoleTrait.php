<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait RoleTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addRole( string|true ...$values ) : static {
        return $this->addAttribute( 'role', ...$values );
    }


    public function getRole() : string|true|null {
        return $this->getAttribute( 'role' );
    }


    public function hasRole( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'role', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function role( false|string|null $value ) : static {
        return $this->setRole( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setRole( bool|string ...$values ) : static {
        return $this->setAttribute( 'role', ...$values );
    }


}
