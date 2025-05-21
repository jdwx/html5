<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait FormTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addForm( string|true ...$values ) : static {
        return $this->addAttribute( 'form', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function form( false|string|null $value ) : static {
        return $this->setForm( $value ?? false );
    }


    public function getForm() : string|true|null {
        return $this->getAttribute( 'form' );
    }


    public function hasForm( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'form', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setForm( bool|string ...$values ) : static {
        return $this->setAttribute( 'form', ...$values );
    }


}
