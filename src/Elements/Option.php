<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\HtmlElement;


class Option extends HtmlElement {


    protected const string TAG_NAME = 'option';


    public function value( string $i_stValue ) : void {
        $this->setAttribute( 'value', $i_stValue );
    }


}


