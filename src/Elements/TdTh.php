<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class TdTh extends Element {


    public function setColSpan( int $i_uColSpan ) : static {
        return $this->setAttribute( 'colspan', strval( $i_uColSpan ) );
    }


    public function setRowSpan( int $i_uRowSpan ) : static {
        return $this->setAttribute( 'colspan', strval( $i_uRowSpan ) );
    }


}
