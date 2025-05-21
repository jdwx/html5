<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


class UnclosedElement extends Element {


    public function __construct( Stringable|array|string $i_children = [] ) {
        parent::__construct( $i_children );
        $this->setAlwaysClose( false );
    }


}
