<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Children;


use JDWX\HTML5\Element;
use JDWX\HTML5\Elements\Li;
use Stringable;


trait ListTrait {


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function li( array|string|Stringable $i_children ) : Li {
        assert( $this instanceof Element );
        return ( new Li( $i_children ) )->withParent( $this );
    }


}
