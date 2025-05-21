<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait AccessKeyTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function accessKey( false|string|null $value ) : static {
        return $this->setAccessKey( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function addAccessKey( string|true ...$values ) : static {
        return $this->addAttribute( 'accesskey', ...$values );
    }


    public function getAccessKey() : string|true|null {
        return $this->getAttribute( 'accesskey' );
    }


    public function hasAccessKey( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'accesskey', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAccessKey( bool|string ...$values ) : static {
        return $this->setAttribute( 'accesskey', ...$values );
    }


}
