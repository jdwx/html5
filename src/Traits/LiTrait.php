<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\HTML5\Element;
use JDWX\HTML5\ElementFactory;
use JDWX\HTML5\Elements\Li;
use Stringable;


trait LiTrait {


    use AbstractElementTrait;


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function li( array|string|Stringable $i_children ) : Li {
        assert( $this instanceof Element );
        return ElementFactory::li( $i_children )->withParent( $this );
    }


}