<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Head extends Element {


    public function __construct( array|string|Stringable $i_rChildren ) {
        parent::__construct( 'head', $i_rChildren );
    }


}


