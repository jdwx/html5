<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait AccessKeyTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function accessKey( string|false|null $value ) : static {
        return $this->setAccessKey( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function addAccessKey( bool|string ...$values ) : static {
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