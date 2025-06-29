<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Blockquote extends Element {


    protected const string TAG_NAME = 'blockquote';


    public function addCite( string|true ...$values ) : static {
        return $this->addAttribute( 'cite', ...$values );
    }


    public function cite( false|string|null $value ) : static {
        return $this->setCite( $value ?? false );
    }


    public function getCite() : string|true|null {
        return $this->getAttribute( 'cite' );
    }


    public function hasCite( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'cite', $value );
    }


    public function setCite( bool|string ...$values ) : static {
        return $this->setAttribute( 'cite', ...$values );
    }


}
