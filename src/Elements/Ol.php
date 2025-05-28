<?php /** @noinspection PhpClassNamingConventionInspection */


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\StartTrait;
use JDWX\HTML5\Attributes\TypeTrait;
use JDWX\HTML5\Children\ListTrait;
use JDWX\HTML5\Element;


class Ol extends Element {


    use ListTrait;
    use StartTrait;
    use TypeTrait;


    protected const string TAG_NAME = 'ol';


    public function addReversed( string|true ...$values ) : static {
        return $this->addAttribute( 'reversed', ...$values );
    }


    public function getReversed() : string|true|null {
        return $this->getAttribute( 'reversed' );
    }


    public function hasReversed( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'reversed', $value );
    }


    public function reversed( ?bool $value ) : static {
        return $this->setReversed( $value ?? false );
    }


    public function setReversed( bool|string ...$values ) : static {
        return $this->setAttribute( 'reversed', ...$values );
    }


}
