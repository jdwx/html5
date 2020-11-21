<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class Label extends Element {


    public function __construct( IParent $i_par, ...$i_rxChildren ) {
        parent::__construct( $i_par, 'label', ... $i_rxChildren );
    }


    public function setFor( string $i_stFor ) : void {
        $this->setAttribute( 'for', $i_stFor );
    }


}


