<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Attributes;


use JDWX\HTML5\Traits\AbstractElementTrait;


trait TabIndexTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addTabIndex( bool|string ...$values ) : static {
        return $this->addAttribute( 'tabindex', ...$values );
    }


    public function getTabIndex() : string|true|null {
        return $this->getAttribute( 'tabindex' );
    }


    public function hasTabIndex( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'tabindex', $value );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setTabIndex( bool|string ...$values ) : static {
        return $this->setAttribute( 'tabindex', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function tabIndex( int|false|null $value ) : static {
        return $this->setTabIndex( is_int( $value ) ? strval( $value ) : false );
    }


}