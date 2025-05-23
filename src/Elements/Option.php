<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\ValueTrait;
use JDWX\HTML5\Element;


class Option extends Element {


    use ValueTrait;


    protected const string TAG_NAME = 'option';


    public function addSelected( string|true ...$values ) : static {
        return $this->addAttribute( 'selected', ...$values );
    }


    public function getSelected() : string|true|null {
        return $this->getAttribute( 'selected' );
    }


    public function hasSelected( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'selected', $value );
    }


    public function selected( ?bool $value ) : static {
        return $this->setSelected( $value ?? false );
    }


    public function setSelected( bool|string ...$values ) : static {
        return $this->setAttribute( 'selected', ...$values );
    }


}
