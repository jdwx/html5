<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait DirTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addDir( string|true ...$values ) : static {
        return $this->addAttribute( 'dir', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function dir( false|string|null $value ) : static {
        return $this->setDir( $value ?? false );
    }


    public function getDir() : string|true|null {
        return $this->getAttribute( 'dir' );
    }


    public function hasDir( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'dir', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setDir( bool|string ...$values ) : static {
        return $this->setAttribute( 'dir', ...$values );
    }


}
