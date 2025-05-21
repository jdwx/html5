<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait DraggableTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addDraggable( string|true ...$values ) : static {
        return $this->addAttribute( 'draggable', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function draggable( ?bool $value = true ) : static {
        return $this->setDraggable( is_bool( $value ) ? ( $value ? 'true' : 'false' ) : false );
    }


    public function getDraggable() : string|true|null {
        return $this->getAttribute( 'draggable' );
    }


    public function hasDraggable( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'draggable', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setDraggable( bool|string ...$values ) : static {
        return $this->setAttribute( 'draggable', ...$values );
    }


}
