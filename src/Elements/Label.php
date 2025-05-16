<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Label extends Element {


    public function __construct( Stringable|array|string $i_body = [] ) {
        parent::__construct( 'label', $i_body );
    }


    public function for( string $x ) : static {
        return $this->setAttribute( 'for', $x );
    }


}
