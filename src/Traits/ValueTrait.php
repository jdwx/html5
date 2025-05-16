<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


trait ValueTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addValue( bool|string ...$x ) : static {
        return $this->addAttribute( 'value', ... $x );
    }


    public function getValue() : true|string|null {
        return $this->getAttribute( 'value' );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setValue( bool|string $x ) : static {
        return $this->setAttribute( 'value', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function value( string|false|null $x ) : static {
        return $this->setAttribute( 'value', $x ?? false );
    }


}