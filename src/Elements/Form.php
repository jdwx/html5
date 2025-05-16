<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Form extends Element {


    public function __construct( Stringable|array|string $i_body = [] ) {
        parent::__construct( 'form', $i_body );
    }


    public function action( string $x ) : static {
        return $this->setAttribute( 'action', $x );
    }


    public function method( string $x ) : static {
        return $this->setAttribute( 'method', $x );
    }


}
