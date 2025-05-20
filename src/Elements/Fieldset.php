<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\HtmlElement;
use JDWX\HTML5\Traits\FormChildTrait;
use Stringable;


class Fieldset extends HtmlElement {


    use FormChildTrait;


    protected const string TAG_NAME = 'fieldset';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function legend( array|string|Stringable $i_children ) : Legend {
        return ( new Legend( $i_children ) )->withParent( $this );
    }


}
