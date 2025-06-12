<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


abstract readonly class AbstractModifier implements ModifierInterface {


    public function __construct( private string|Stringable|null $nstContent = null ) {}


    public function __toString() : string {
        return strval( $this->content() ?? '' );
    }


    public function content() : string|Stringable|null {
        return $this->nstContent;
    }


}
