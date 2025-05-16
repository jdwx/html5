<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use Stringable;


/** @noinspection PhpClassNamingConventionInspection */


class Ol extends ListElement {


    public function __construct( array|string|Stringable $i_children ) {
        parent::__construct( 'ol', $i_children );
    }


}


