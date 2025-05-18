<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait TranslateTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addTranslate( bool|string ...$values ) : static {
        return $this->addAttribute( 'translate', ...$values );
    }


    public function getTranslate() : string|true|null {
        return $this->getAttribute( 'translate' );
    }


    public function hasTranslate( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'translate', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setTranslate( bool|string ...$values ) : static {
        return $this->setAttribute( 'translate', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function translate( ?bool $value = true ) : static {
        return $this->setTranslate( is_bool( $value ) ? ( $value ? true : 'no' ) : false );
    }


}
