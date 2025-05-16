<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Option extends Element {


    protected const string TAG_NAME = 'option';


    public function value( string $i_stValue ) : void {
        $this->setAttribute( 'value', $i_stValue );
    }


}


