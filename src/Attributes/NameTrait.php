<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait NameTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addName( bool|string ...$values ) : static {
        return $this->addAttribute( 'name', ...$values );
    }


    public function getName() : string|true|null {
        return $this->getAttribute( 'name' );
    }


    public function hasName( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'name', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function name( string|false|null $value ) : static {
        return $this->setName( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setName( bool|string ...$values ) : static {
        return $this->setAttribute( 'name', ...$values );
    }


}
