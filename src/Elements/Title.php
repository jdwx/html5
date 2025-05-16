<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Title extends Element {


    public function __construct( array|string|Stringable $i_children ) {
        parent::__construct( 'title', $i_children );
    }


}


