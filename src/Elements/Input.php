<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\PlaceholderTrait;
use JDWX\HTML5\Attributes\ValueTrait;
use JDWX\HTML5\Traits\FormChildTrait;
use JDWX\HTML5\UnclosedElement;


class Input extends UnclosedElement {


    use FormChildTrait;
    use PlaceholderTrait;
    use ValueTrait;


    protected const string TAG_NAME = 'input';


    public function addChecked( bool|string ...$values ) : static {
        return $this->addAttribute( 'checked', ...$values );
    }


    public function addMax( bool|string ...$values ) : static {
        return $this->addAttribute( 'max', ...$values );
    }


    public function addMaxLength( bool|string ...$values ) : static {
        return $this->addAttribute( 'maxlength', ...$values );
    }


    public function addMin( bool|string ...$values ) : static {
        return $this->addAttribute( 'min', ...$values );
    }


    public function addPattern( bool|string ...$values ) : static {
        return $this->addAttribute( 'pattern', ...$values );
    }


    public function addSize( bool|string ...$values ) : static {
        return $this->addAttribute( 'size', ...$values );
    }


    public function addType( bool|string ...$values ) : static {
        return $this->addAttribute( 'type', ...$values );
    }


    public function checked( ?bool $value ) : static {
        return $this->setChecked( $value ?? false );
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


    public function getType() : bool|string|null {
        return $this->getAttribute( 'type' );
    }


    public function hasChecked( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'checked', $value );
    }


    public function hasMax( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'max', $value );
    }


    public function hasMaxLength( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'maxlength', $value );
    }


    public function hasMin( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'min', $value );
    }


    public function hasPattern( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'pattern', $value );
    }


    public function hasSize( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'size', $value );
    }


    public function hasType( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'type', $value );
    }


    public function max( float|int|false|null $value ) : static {
        return $this->setMax( is_int( $value ) || is_float( $value ) ? strval( $value ) : false );
    }


    public function maxLength( int|false|null $value ) : static {
        return $this->setMaxLength( is_int( $value ) ? strval( $value ) : false );
    }


    public function min( float|int|false|null $value ) : static {
        return $this->setMin( is_int( $value ) || is_float( $value ) ? strval( $value ) : false );
    }


    public function pattern( string|false|null $value ) : static {
        return $this->setPattern( $value ?? false );
    }


    public function setChecked( bool|string ...$values ) : static {
        return $this->setAttribute( 'checked', ...$values );
    }


    public function setMax( bool|string ...$values ) : static {
        return $this->setAttribute( 'max', ...$values );
    }


    public function setMaxLength( bool|string ...$values ) : static {
        return $this->setAttribute( 'maxlength', ...$values );
    }


    public function setMin( bool|string ...$values ) : static {
        return $this->setAttribute( 'min', ...$values );
    }


    public function setPattern( bool|string ...$values ) : static {
        return $this->setAttribute( 'pattern', ...$values );
    }


    public function setSize( bool|string ...$values ) : static {
        return $this->setAttribute( 'size', ...$values );
    }


    public function setType( bool|string ...$values ) : static {
        return $this->setAttribute( 'type', ...$values );
    }


    public function size( int|false|null $value ) : static {
        return $this->setSize( is_int( $value ) ? strval( $value ) : false );
    }


    public function type( string|false|null $value ) : static {
        return $this->setType( $value ?? false );
    }


}
