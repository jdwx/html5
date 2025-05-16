<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


/** @noinspection PhpClassNamingConventionInspection */


class Li extends Element {


    public function __construct( array|string|\Stringable $i_children ) {
        parent::__construct( 'li', $i_children );
    }


}


