<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\UnclosedHtmlElement;


class Link extends UnclosedHtmlElement {


    protected const string TAG_NAME = 'link';


    public function href( string $i_strHref ) : static {
        return $this->setAttribute( 'href', $i_strHref );
    }


    public function rel( string $i_strRel ) : static {
        return $this->setAttribute( 'rel', $i_strRel );
    }


    public function sizes( string $i_stSizes ) : static {
        return $this->setAttribute( 'sizes', $i_stSizes );
    }


    public function type( string $i_strType ) : static {
        return $this->setAttribute( 'type', $i_strType );
    }


}


