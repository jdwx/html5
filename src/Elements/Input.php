<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Input extends Element {


    public function __construct( Stringable|array|string $i_body = [] ) {
        parent::__construct( 'input', $i_body );
        $this->setAlwaysClose( false );
    }


    public function maxLength( int $x ) : static {
        return $this->setAttribute( 'maxlength', strval( $x ) );
    }


    public function name( string $x ) : static {
        return $this->setAttribute( 'name', $x );
    }


    public function placeholder( string $x ) : static {
        return $this->setAttribute( 'placeholder', $x );
    }


    public function type( string $x ) : static {
        return $this->setAttribute( 'type', $x );
    }


    public function value( string $x ) : static {
        return $this->setAttribute( 'value', $x );
    }


}
