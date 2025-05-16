<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Table extends Element {


    public function __construct( Stringable|array|string $i_body = [] ) {
        parent::__construct( 'table', $i_body );
    }


    public function tbody( ...$x ) : TBodyFootHead {
        return ( new TBodyFootHead( 'tbody', ... $x ) )->withParent( $this );
    }


    public function tfoot( ...$x ) : TBodyFootHead {
        return ( new TBodyFootHead( 'tfoot', ... $x ) )->withParent( $this );
    }


    public function thead( ...$x ) : TBodyFootHead {
        return ( new TBodyFootHead( 'thead', ... $x ) )->withParent( $this );
    }


}
