<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait ContentEditableTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addContentEditable( bool|string ...$values ) : static {
        return $this->addAttribute( 'contenteditable', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function contentEditable( bool|string|null $value = true ) : static {
        return $this->setContentEditable( is_bool( $value ) ? ( $value ? 'true' : 'false' ) : ( $value ?? false ) );
    }


    public function getContentEditable() : string|true|null {
        return $this->getAttribute( 'contenteditable' );
    }


    public function hasContentEditable( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'contenteditable', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setContentEditable( bool|string ...$values ) : static {
        return $this->setAttribute( 'contenteditable', ...$values );
    }


}
