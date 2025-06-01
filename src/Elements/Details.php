<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\NameTrait;
use JDWX\HTML5\Element;
use Stringable;


class Details extends Element {


    use NameTrait;


    protected const string TAG_NAME = 'details';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function summary( array|string|Stringable $i_children = [] ) : Summary {
        return ( new Summary( $i_children ) )->withParent( $this );
    }


    public function addOpen( string|true ...$values ) : static {
        return $this->addAttribute( 'open', ...$values );
    }


    public function getOpen() : string|true|null {
        return $this->getAttribute( 'open' );
    }


    public function hasOpen( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'open', $value );
    }


    public function open( ?bool $value ) : static {
        return $this->setOpen( $value ?? false );
    }


    public function setOpen( bool|string ...$values ) : static {
        return $this->setAttribute( 'open', ...$values );
    }


}
