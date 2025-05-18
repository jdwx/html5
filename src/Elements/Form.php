<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Form extends Element {


    protected const string TAG_NAME = 'form';


    public function action( string|false|null $value ) : static {
        return $this->setAction( $value ?? false );
    }


    public function addAction( bool|string ...$values ) : static {
        return $this->addAttribute( 'action', ...$values );
    }


    public function addEncType( bool|string ...$values ) : static {
        return $this->addAttribute( 'enctype', ...$values );
    }


    public function addMethod( bool|string ...$values ) : static {
        return $this->addAttribute( 'method', ...$values );
    }


    public function encType( string|false|null $value ) : static {
        return $this->setEncType( $value ?? false );
    }


    public function getAction() : bool|string|null {
        return $this->getAttribute( 'action' );
    }


    public function getEncType() : bool|string|null {
        return $this->getAttribute( 'enctype' );
    }


    public function getMethod() : bool|string|null {
        return $this->getAttribute( 'method' );
    }


    public function hasAction( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'action', $value );
    }


    public function hasEncType( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'enctype', $value );
    }


    public function hasMethod( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'method', $value );
    }


    public function method( string|false|null $value ) : static {
        return $this->setMethod( $value ?? false );
    }


    public function setAction( bool|string ...$values ) : static {
        return $this->setAttribute( 'action', ...$values );
    }


    public function setEncType( bool|string ...$values ) : static {
        return $this->setAttribute( 'enctype', ...$values );
    }


    public function setMethod( bool|string ...$values ) : static {
        return $this->setAttribute( 'method', ...$values );
    }


}
