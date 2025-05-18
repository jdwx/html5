<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait PlaceholderTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addPlaceholder( bool|string ...$values ) : static {
        return $this->addAttribute( 'placeholder', ...$values );
    }


    public function getPlaceholder() : string|true|null {
        return $this->getAttribute( 'placeholder' );
    }


    public function hasPlaceholder( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'placeholder', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function placeholder( string|false|null $value ) : static {
        return $this->setPlaceholder( $value ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setPlaceholder( bool|string ...$values ) : static {
        return $this->setAttribute( 'placeholder', ...$values );
    }


}
