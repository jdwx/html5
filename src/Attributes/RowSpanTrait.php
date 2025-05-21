<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait RowSpanTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addRowSpan( string|true ...$values ) : static {
        return $this->addAttribute( 'rowspan', ...$values );
    }


    public function getRowSpan() : string|true|null {
        return $this->getAttribute( 'rowspan' );
    }


    public function hasRowSpan( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'rowspan', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function rowSpan( false|int|null $value ) : static {
        return $this->setRowSpan( is_int( $value ) ? strval( $value ) : false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setRowSpan( bool|string ...$values ) : static {
        return $this->setAttribute( 'rowspan', ...$values );
    }


}
