<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


trait PlaceholderTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addPlaceholder( bool|string ...$x ) : static {
        return $this->addAttribute( 'placeholder', ... $x );
    }


    public function getPlaceholder() : true|string|null {
        return $this->getAttribute( 'placeholder' );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function placeholder( string|false|null $x ) : static {
        return $this->setPlaceholder( $x ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setPlaceholder( bool|string ...$x ) : static {
        return $this->setAttribute( 'placeholder', ...$x );
    }


}