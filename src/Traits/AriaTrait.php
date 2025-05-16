<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


trait AriaTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addAriaLabel( bool|string ...$x ) : static {
        return $this->addAttribute( 'aria-label', ... $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function ariaLabel( string|false|null $i_stLabel ) : static {
        return $this->setAriaLabel( $i_stLabel ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAriaLabel( bool|string ...$x ) : static {
        return $this->setAttribute( 'aria-label', ...$x );
    }


}