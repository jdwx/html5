<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractAttributeTrait;


trait PlaceholderTrait {


    use AbstractAttributeTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addPlaceholder( string|true ...$values ) : static {
        return $this->addAttribute( 'placeholder', ...$values );
    }


    public function getPlaceholder() : string|true|null {
        return $this->getAttribute( 'placeholder' );
    }


    public function hasPlaceholder( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'placeholder', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function placeholder( false|string|null $value ) : static {
        return $this->setPlaceholder( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setPlaceholder( bool|string ...$values ) : static {
        return $this->setAttribute( 'placeholder', ...$values );
    }


}
