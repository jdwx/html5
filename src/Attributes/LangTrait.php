<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait LangTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addLang( string|true ...$values ) : static {
        return $this->addAttribute( 'lang', ...$values );
    }


    public function getLang() : string|true|null {
        return $this->getAttribute( 'lang' );
    }


    public function hasLang( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'lang', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function lang( false|string|null $value ) : static {
        return $this->setLang( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setLang( bool|string ...$values ) : static {
        return $this->setAttribute( 'lang', ...$values );
    }


}
