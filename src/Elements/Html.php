<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Html extends Element {


    public const string DEFAULT_LANG = 'en';


    protected const string TAG_NAME = 'html';


    public function __construct( array|string|Stringable $i_children = [] ) {
        parent::__construct( $i_children );
        $this->lang( self::DEFAULT_LANG );
    }


}


