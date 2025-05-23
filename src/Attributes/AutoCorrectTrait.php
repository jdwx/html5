<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait AutoCorrectTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addAutoCorrect( string|true ...$values ) : static {
        return $this->addAttribute( 'autocorrect', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function autoCorrect( ?bool $value ) : static {
        return $this->setAutoCorrect( is_bool( $value ) ? ( $value ? true : 'off' ) : false );
    }


    public function getAutoCorrect() : string|true|null {
        return $this->getAttribute( 'autocorrect' );
    }


    public function hasAutoCorrect( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'autocorrect', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAutoCorrect( bool|string ...$values ) : static {
        return $this->setAttribute( 'autocorrect', ...$values );
    }


}
