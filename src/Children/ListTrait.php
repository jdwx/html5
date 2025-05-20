<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Children;


use JDWX\HTML5\Elements\Li;
use JDWX\HTML5\HtmlElement;
use Stringable;


trait ListTrait {


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function li( array|string|Stringable $i_children ) : Li {
        assert( $this instanceof HtmlElement );
        return ( new Li( $i_children ) )->withParent( $this );
    }


}
