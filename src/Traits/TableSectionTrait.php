<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\HTML5\Element;
use JDWX\HTML5\ElementFactory;
use JDWX\HTML5\Elements\Tr;
use Stringable;


trait TableSectionTrait {


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function tr( array|string|Stringable $i_children ) : Tr {
        assert( $this instanceof Element );
        return ElementFactory::tr( $i_children )->withParent( $this );
    }


}

