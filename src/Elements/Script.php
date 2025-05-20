<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\HtmlElement;


class Script extends HtmlElement {


    protected const string TAG_NAME = 'script';


    public function src( string|false|null $i_src ) : static {
        return $this->setAttribute( 'src', $i_src ?? false );
    }


}


