<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait TitleTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addTitle( bool|string ...$values ) : static {
        return $this->addAttribute( 'title', ...$values );
    }


    public function getTitle() : string|true|null {
        return $this->getAttribute( 'title' );
    }


    public function hasTitle( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'title', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setTitle( bool|string ...$values ) : static {
        return $this->setAttribute( 'title', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function title( string|false|null $value ) : static {
        return $this->setTitle( $value ?? false );
    }


}
