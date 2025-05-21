<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait SpellCheckTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addSpellCheck( string|true ...$values ) : static {
        return $this->addAttribute( 'spellcheck', ...$values );
    }


    public function getSpellCheck() : string|true|null {
        return $this->getAttribute( 'spellcheck' );
    }


    public function hasSpellCheck( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'spellcheck', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setSpellCheck( bool|string ...$values ) : static {
        return $this->setAttribute( 'spellcheck', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function spellCheck( ?bool $value = true ) : static {
        return $this->setSpellCheck( is_bool( $value ) ? ( $value ? 'true' : 'false' ) : false );
    }


}
