<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\Traits\FormChildTrait;
use Stringable;


class Select extends Element {


    use FormChildTrait;


    protected const string TAG_NAME = 'select';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function option( array|string|Stringable $i_children = [] ) : Option {
        return ( new Option( $i_children ) )->withParent( $this );
    }


    public function addMultiple( string|true ...$values ) : static {
        return $this->addAttribute( 'multiple', ...$values );
    }


    public function getMultiple() : string|true|null {
        return $this->getAttribute( 'multiple' );
    }


    public function hasMultiple( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'multiple', $value );
    }


    public function multiple( ?bool $value ) : static {
        return $this->setMultiple( $value ?? false );
    }


    public function setMultiple( bool|string ...$values ) : static {
        return $this->setAttribute( 'multiple', ...$values );
    }


}
