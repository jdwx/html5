<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Label extends Element {


    protected const string TAG_NAME = 'label';


    public function addFor( string ...$x ) : void {
        $this->addAttribute( 'for', ...$x );
    }


    public function for( string|false|null $x ) : void {
        $this->setFor( $x ?? false );
    }


    public function getFor() : bool|string|null {
        return $this->getAttribute( 'for' );
    }


    public function hasFor() : bool {
        return $this->hasAttribute( 'for' );
    }


    public function setFor( bool|string $x ) : static {
        return $this->setAttribute( 'for', $x );
    }


}
