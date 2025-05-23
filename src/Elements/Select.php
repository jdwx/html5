<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\Traits\FormChildTrait;
use Stringable;


class Select extends Element {


    use FormChildTrait;


    protected const string TAG_NAME = 'select';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function option( array|string|Stringable $i_children = [] ) : Option {
        return ( new Option( $i_children ) )->withParent( $this );
    }


}
