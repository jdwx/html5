<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class HTML extends Element {


    public const string DEFAULT_LANG = 'en';


    public function __construct( array|string|Stringable $i_children = [] ) {
        parent::__construct( 'html', $i_children );
        $this->lang( self::DEFAULT_LANG );
    }


}


