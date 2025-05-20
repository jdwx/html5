<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\HtmlElement;


class Label extends HtmlElement {


    protected const string TAG_NAME = 'label';


    public function addFor( bool|string ...$values ) : static {
        return $this->addAttribute( 'for', ...$values );
    }


    public function for( string|false|null $value ) : static {
        return $this->setFor( $value ?? false );
    }


    public function getFor() : bool|string|null {
        return $this->getAttribute( 'for' );
    }


    public function hasFor( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'for', $value );
    }


    public function setFor( bool|string ...$values ) : static {
        return $this->setAttribute( 'for', ...$values );
    }


}
