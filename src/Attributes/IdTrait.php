<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait IdTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addId( string|true ...$values ) : static {
        return $this->addAttribute( 'id', ...$values );
    }


    public function getId() : string|true|null {
        return $this->getAttribute( 'id' );
    }


    public function getIdEx() : string {
        return $this->getAttributeStringEx( 'id' );
    }


    public function hasId( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'id', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function id( false|string|null $value ) : static {
        return $this->setId( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setId( bool|string ...$values ) : static {
        return $this->setAttribute( 'id', ...$values );
    }


}
