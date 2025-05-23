<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait AutoCapitalizeTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addAutoCapitalize( string|true ...$values ) : static {
        return $this->addAttribute( 'autocapitalize', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function autoCapitalize( false|string|null $value ) : static {
        return $this->setAutoCapitalize( $value ?? false );
    }


    public function getAutoCapitalize() : string|true|null {
        return $this->getAttribute( 'autocapitalize' );
    }


    public function hasAutoCapitalize( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'autocapitalize', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAutoCapitalize( bool|string ...$values ) : static {
        return $this->setAttribute( 'autocapitalize', ...$values );
    }


}
