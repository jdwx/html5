<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


trait TdThTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function colSpan( int $i_uColSpan ) : static {
        return $this->setAttribute( 'colspan', strval( $i_uColSpan ) );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function rowSpan( int $i_uRowSpan ) : static {
        return $this->setAttribute( 'colspan', strval( $i_uRowSpan ) );
    }


}