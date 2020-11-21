<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\IParent;


class Ol extends \JDWX\HTML5\Element {


    public function __construct( IParent $i_par, ... $i_rxChildren ) {
        parent::__construct( $i_par, 'ol', ... $i_rxChildren );
    }


}


