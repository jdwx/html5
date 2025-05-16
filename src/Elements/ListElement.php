<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\ElementFactory;
use Stringable;


class ListElement extends Element {


    public function li( array|string|Stringable $i_children ) : Element {
        return ElementFactory::li( $i_children )->withParent( $this );
    }


}
