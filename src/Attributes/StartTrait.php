<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait StartTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addStart( string|true ...$values ) : static {
        return $this->addAttribute( 'start', ...$values );
    }


    public function getStart() : string|true|null {
        return $this->getAttribute( 'start' );
    }


    public function hasStart( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'start', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setStart( bool|string ...$values ) : static {
        return $this->setAttribute( 'start', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function start( false|string|null $value ) : static {
        return $this->setStart( $value ?? false );
    }


}
