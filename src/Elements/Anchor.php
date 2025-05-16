<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Anchor extends Element {


    public function __construct( Stringable|array|string $i_body = [] ) {
        parent::__construct( 'a', $i_body );
    }


    public function download( string $x ) : static {
        return $this->setAttribute( 'download', $x );
    }


    public function href( string $x ) : static {
        return $this->setAttribute( 'href', $x );
    }


    public function target( string $x ) : static {
        return $this->setAttribute( 'target', $x );
    }


}
