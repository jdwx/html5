<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Label extends Element {


    protected const string TAG_NAME = 'label';


    public function addFor( string|true ...$values ) : static {
        return $this->addAttribute( 'for', ...$values );
    }


    public function for( false|string|null $value ) : static {
        return $this->setFor( $value ?? false );
    }


    public function getFor() : string|true|null {
        return $this->getAttribute( 'for' );
    }


    public function hasFor( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'for', $value );
    }


    public function setFor( bool|string ...$values ) : static {
        return $this->setAttribute( 'for', ...$values );
    }


}
