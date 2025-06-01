<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait OnClickTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addOnClick( string|true ...$values ) : static {
        return $this->addAttribute( 'onclick', ...$values );
    }


    public function getOnClick() : string|true|null {
        return $this->getAttribute( 'onclick' );
    }


    public function hasOnClick( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'onclick', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function onClick( false|string|null $value ) : static {
        return $this->setOnClick( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setOnClick( bool|string ...$values ) : static {
        return $this->setAttribute( 'onclick', ...$values );
    }


}
