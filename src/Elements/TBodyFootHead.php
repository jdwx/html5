<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\ElementFactory;


class TBodyFootHead extends Element {


    public function tr( ...$x ) : Tr {
        return ElementFactory::tr( ... $x )->withParent( $this );
    }


}
