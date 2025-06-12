<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


class UnclosedElement extends Element {


    /** @param iterable<string|Stringable>|string|Stringable $i_children */
    public function __construct( iterable|string|Stringable $i_children = [] ) {
        parent::__construct( $i_children );
        $this->setAlwaysClose( false );
    }


}
