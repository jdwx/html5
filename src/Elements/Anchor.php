<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Anchor extends Element {


    protected const string TAG_NAME = 'a';


    public function download( bool|string $x ) : static {
        return $this->setAttribute( 'download', $x );
    }


    public function href( string $x ) : static {
        return $this->setAttribute( 'href', $x );
    }


    public function hrefLang( string $x ) : static {
        return $this->setAttribute( 'hreflang', $x );
    }


    public function media( string $x ) : static {
        return $this->setAttribute( 'media', $x );
    }


    public function ping( string $x ) : static {
        return $this->addAttribute( 'ping', $x );
    }


    public function rel( string $x ) : static {
        return $this->addAttribute( 'rel', $x );
    }


    public function target( string $x ) : static {
        return $this->setAttribute( 'target', $x );
    }


}
