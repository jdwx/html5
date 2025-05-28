<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait TypeTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addType( string|true ...$values ) : static {
        return $this->addAttribute( 'type', ...$values );
    }


    public function getType() : string|true|null {
        return $this->getAttribute( 'type' );
    }


    public function hasType( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'type', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setType( bool|string ...$values ) : static {
        return $this->setAttribute( 'type', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function type( false|string|null $value ) : static {
        return $this->setType( $value ?? false );
    }


}
