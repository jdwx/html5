<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Form extends Element {


    protected const string TAG_NAME = 'form';


    public function action( ?string $x ) : static {
        return $this->setAction( $x ?? false );
    }


    public function getAction() : bool|string|null {
        return $this->getAttribute( 'action' );
    }


    public function getMethod() : bool|string|null {
        return $this->getAttribute( 'method' );
    }


    public function method( string $x ) : static {
        return $this->setAttribute( 'method', $x );
    }


    public function setAction( bool|string $i_bstAction ) : static {
        return $this->setAttribute( 'action', $i_bstAction );
    }


    public function setEncType( bool|string $i_bstEncType ) : static {
        return $this->setAttribute( 'enctype', $i_bstEncType );
    }


}
