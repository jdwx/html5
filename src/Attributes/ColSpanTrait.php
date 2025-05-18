<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait ColSpanTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addColSpan( bool|string ...$values ) : static {
        return $this->addAttribute( 'colspan', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function colSpan( int|false|null $value ) : static {
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