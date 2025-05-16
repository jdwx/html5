<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Body extends Element {


    public function __construct( array $i_rChildren ) {
        parent::__construct( 'body', $i_rChildren );
    }


}


