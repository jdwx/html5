<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Script extends Element {


    protected const string TAG_NAME = 'script';


    public function src( string|false|null $i_src ) : static {
        return $this->setAttribute( 'src', $i_src ?? false );
    }


}


