<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


trait FormChildTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function disabled( ?bool $x = true ) : static {
        return $this->setDisabled( $x ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function form( string|false|null $x ) : static {
        return $this->setForm( $x ?? false );
    }


    public function getDisabled() : bool|string|null {
        return $this->getAttribute( 'disabled' );
    }


    public function getForm() : bool|string|null {
        return $this->getAttribute( 'form' );
    }


    public function getName() : bool|string|null {
        return $this->getAttribute( 'name' );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function name( ?string $i_nstName ) : static {
        return $this->setName( $i_nstName ?? false );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setDisabled( bool|string $i_bDisabled ) : static {
        return $this->setAttribute( 'disabled', $i_bDisabled );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setForm( bool|string $i_nstForm ) : static {
        return $this->setAttribute( 'form', $i_nstForm );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setName( bool|string $i_nstName ) : static {
        return $this->setAttribute( 'name', $i_nstName );
    }


}