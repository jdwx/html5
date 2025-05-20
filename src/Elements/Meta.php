<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\UnclosedHtmlElement;


class Meta extends UnclosedHtmlElement {


    protected const string TAG_NAME = 'meta';


    public function charset( string $i_stCharset ) : static {
        return $this->setAttribute( 'charset', $i_stCharset );
    }


    public function setContent( string $i_stContent ) : static {
        return $this->setAttribute( 'content', $i_stContent );
    }


    public function setName( string $i_stName ) : static {
        return $this->setAttribute( 'name', $i_stName );
    }


}


