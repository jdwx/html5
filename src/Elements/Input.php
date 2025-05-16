<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Traits\FormChildTrait;
use JDWX\HTML5\Traits\PlaceholderTrait;
use JDWX\HTML5\Traits\ValueTrait;
use JDWX\HTML5\UnclosedElement;


class Input extends UnclosedElement {


    use FormChildTrait;
    use PlaceholderTrait;
    use ValueTrait;


    protected const string TAG_NAME = 'input';


    public function checked( bool|null $x ) : static {
        return $this->setAttribute( 'checked', $x ?? false );
    }


    public function getChecked() : bool|string|null {
        return $this->getAttribute( 'checked' );
    }


    public function getMax() : bool|string|null {
        return $this->getAttribute( 'max' );
    }


    public function getMaxLength() : bool|string|null {
        return $this->getAttribute( 'maxlength' );
    }


    public function getMin() : bool|string|null {
        return $this->getAttribute( 'min' );
    }


    public function getPattern() : bool|string|null {
        return $this->getAttribute( 'pattern' );
    }


    public function getSize() : bool|string|null {
        return $this->getAttribute( 'size' );
    }


    public function hasChecked( bool|string|null $i_value = null ) : bool {
        return $this->hasAttribute( 'checked', $i_value );
    }


    public function hasMax( bool|string|null $i_value = null ) : bool {
        return $this->hasAttribute( 'max', $i_value );
    }


    public function hasMaxLength( bool|string|null $i_value = null ) : bool {
        return $this->hasAttribute( 'maxlength', $i_value );
    }


    public function hasMin( bool|string|null $i_value = null ) : bool {
        return $this->hasAttribute( 'min', $i_value );
    }


    public function hasPattern( bool|string|null $i_value = null ) : bool {
        return $this->hasAttribute( 'pattern', $i_value );
    }


    public function hasSize( bool|string|null $i_value = null ) : bool {
        return $this->hasAttribute( 'size', $i_value );
    }


    public function max( int|float|false|null $x ) : static {
        return $this->setAttribute( 'max', is_int( $x ) || is_float( $x ) ? strval( $x ) : false );
    }


    public function maxLength( int|false|null $x ) : static {
        return $this->setAttribute( 'maxlength', is_int( $x ) ? strval( $x ) : false );
    }


    public function min( int|float|false|null $x ) : static {
        return $this->setAttribute( 'min', is_int( $x ) || is_float( $x ) ? strval( $x ) : false );
    }


    public function pattern( string|false|null $x ) : static {
        return $this->setAttribute( 'pattern', $x ?? false );
    }


    public function setChecked( bool|string $x ) : static {
        return $this->setAttribute( 'checked', $x );
    }


    public function setMax( bool|string $x ) : static {
        return $this->setAttribute( 'max', $x );
    }


    public function setMaxLength( bool|string $x ) : static {
        return $this->setAttribute( 'maxlength', $x );
    }


    public function setMin( bool|string $x ) : static {
        return $this->setAttribute( 'min', $x );
    }


    public function setPattern( bool|string $x ) : static {
        return $this->setAttribute( 'pattern', $x );
    }


    public function setSize( bool|string $i_bstSize ) : static {
        return $this->setAttribute( 'size', $i_bstSize );
    }


    public function size( int|false|null $x ) : static {
        return $this->setAttribute( 'size', is_int( $x ) ? strval( $x ) : false );
    }


    public function type( string $x ) : static {
        return $this->setAttribute( 'type', $x );
    }


}
