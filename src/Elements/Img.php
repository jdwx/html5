<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\UnclosedElement;


class Img extends UnclosedElement {


    protected const string TAG_NAME = 'img';


    public function alt( string $i_strAlt ) : static {
        return $this->setAttribute( 'alt', $i_strAlt );
    }


    public function src( string $i_strSrc ) : static {
        return $this->setAttribute( 'src', $i_strSrc );
    }


}


