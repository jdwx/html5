<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\NameTrait;
use JDWX\HTML5\Element;


class Meta extends Element {


    use NameTrait;


    protected const string TAG_NAME = 'meta';


    public function addCharset( string|true ...$values ) : static {
        return $this->addAttribute( 'charset', ...$values );
    }


    public function addContent( string|true ...$values ) : static {
        return $this->addAttribute( 'content', ...$values );
    }


    public function addHttpEquiv( string|true ...$values ) : static {
        return $this->addAttribute( 'http-equiv', ...$values );
    }


    public function charset( false|string|null $value ) : static {
        return $this->setCharset( $value ?? false );
    }


    public function content( false|string|null $value ) : static {
        return $this->setContent( $value ?? false );
    }


    public function getCharset() : string|true|null {
        return $this->getAttribute( 'charset' );
    }


    public function getContent() : string|true|null {
        return $this->getAttribute( 'content' );
    }


    public function getHttpEquiv() : string|true|null {
        return $this->getAttribute( 'http-equiv' );
    }


    public function hasCharset( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'charset', $value );
    }


    public function hasContent( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'content', $value );
    }


    public function hasHttpEquiv( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'http-equiv', $value );
    }


    public function httpEquiv( false|string|null $value ) : static {
        return $this->setHttpEquiv( $value ?? false );
    }


    public function setCharset( bool|string ...$values ) : static {
        return $this->setAttribute( 'charset', ...$values );
    }


    public function setContent( bool|string ...$values ) : static {
        return $this->setAttribute( 'content', ...$values );
    }


    public function setHttpEquiv( bool|string ...$values ) : static {
        return $this->setAttribute( 'http-equiv', ...$values );
    }


}
