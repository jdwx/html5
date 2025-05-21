<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait ColSpanTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addColSpan( string|true ...$values ) : static {
        return $this->addAttribute( 'colspan', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function colSpan( false|int|null $value ) : static {
        return $this->setColSpan( is_int( $value ) ? strval( $value ) : false );
    }


    public function getColSpan() : string|true|null {
        return $this->getAttribute( 'colspan' );
    }


    public function hasColSpan( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'colspan', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setColSpan( bool|string ...$values ) : static {
        return $this->setAttribute( 'colspan', ...$values );
    }


}
