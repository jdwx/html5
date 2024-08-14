<?php


declare( strict_types = 1 );


use JDWX\HTML5\Element;


class ElementHack extends Element {


    /** @param Stringable|string|int|float|bool|mixed[]|null|resource $i_xChild */
    public function myRenderChild( mixed $i_xChild ) : string {
        return parent::renderChild( $i_xChild );
    }


}


