<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\PlaceholderTrait;
use JDWX\HTML5\Attributes\TypeTrait;
use JDWX\HTML5\Attributes\ValueTrait;
use JDWX\HTML5\Traits\FormChildTrait;
use JDWX\HTML5\UnclosedElement;


class Input extends UnclosedElement {


    use FormChildTrait;
    use PlaceholderTrait;
    use TypeTrait;
    use ValueTrait;


    protected const string TAG_NAME = 'input';


    public function addAutoComplete( string|true ...$values ) : static {
        return $this->addAttribute( 'autocomplete', ...$values );
    }


    public function addAutoFocus( string|true ...$values ) : static {
        return $this->addAttribute( 'autofocus', ...$values );
    }


    public function addChecked( string|true ...$values ) : static {
        return $this->addAttribute( 'checked', ...$values );
    }


    public function addFormNoValidate( string|true ...$values ) : static {
        return $this->addAttribute( 'formnovalidate', ...$values );
    }


    public function addMax( string|true ...$values ) : static {
        return $this->addAttribute( 'max', ...$values );
    }


    public function addMaxLength( string|true ...$values ) : static {
        return $this->addAttribute( 'maxlength', ...$values );
    }


    public function addMin( string|true ...$values ) : static {
        return $this->addAttribute( 'min', ...$values );
    }


    public function addPattern( string|true ...$values ) : static {
        return $this->addAttribute( 'pattern', ...$values );
    }


    public function addSize( string|true ...$values ) : static {
        return $this->addAttribute( 'size', ...$values );
    }


    public function addStep( string|true ...$values ) : static {
        return $this->addAttribute( 'step', ...$values );
    }


    public function autoComplete( false|string|null ...$values ) : static {
        return $this->addAttributeFromBare( 'autocomplete', ...$values );
    }


    public function autoFocus( ?bool $value ) : static {
        return $this->setAutoFocus( $value ?? false );
    }


    public function checked( ?bool $value = true ) : static {
        return $this->setChecked( $value ?? false );
    }


    public function formNoValidate( ?bool $value = true ) : static {
        return $this->setFormNoValidate( $value ?? false );
    }


    public function getAutoComplete() : string|true|null {
        return $this->getAttribute( 'autocomplete' );
    }


    public function getAutoFocus() : string|true|null {
        return $this->getAttribute( 'autofocus' );
    }


    public function getChecked() : string|true|null {
        return $this->getAttribute( 'checked' );
    }


    public function getFormNoValidate() : string|true|null {
        return $this->getAttribute( 'formnovalidate' );
    }


    public function getMax() : string|true|null {
        return $this->getAttribute( 'max' );
    }


    public function getMaxLength() : string|true|null {
        return $this->getAttribute( 'maxlength' );
    }


    public function getMin() : string|true|null {
        return $this->getAttribute( 'min' );
    }


    public function getPattern() : string|true|null {
        return $this->getAttribute( 'pattern' );
    }


    public function getSize() : string|true|null {
        return $this->getAttribute( 'size' );
    }


    public function getStep() : string|true|null {
        return $this->getAttribute( 'step' );
    }


    public function hasAutoComplete( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'autocomplete', $value );
    }


    public function hasAutoFocus( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'autofocus', $value );
    }


    public function hasChecked( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'checked', $value );
    }


    public function hasFormNoValidate( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'formnovalidate', $value );
    }


    public function hasMax( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'max', $value );
    }


    public function hasMaxLength( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'maxlength', $value );
    }


    public function hasMin( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'min', $value );
    }


    public function hasPattern( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'pattern', $value );
    }


    public function hasSize( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'size', $value );
    }


    public function hasStep( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'step', $value );
    }


    public function max( false|float|int|null $value ) : static {
        return $this->setMax( is_int( $value ) || is_float( $value ) ? strval( $value ) : false );
    }


    public function maxLength( false|int|null $value ) : static {
        return $this->setMaxLength( is_int( $value ) ? strval( $value ) : false );
    }


    public function min( false|float|int|null $value ) : static {
        return $this->setMin( is_int( $value ) || is_float( $value ) ? strval( $value ) : false );
    }


    public function pattern( false|string|null $value ) : static {
        return $this->setPattern( $value ?? false );
    }


    public function setAutoComplete( bool|string ...$values ) : static {
        return $this->setAttribute( 'autocomplete', ...$values );
    }


    public function setAutoFocus( bool|string ...$values ) : static {
        return $this->setAttribute( 'autofocus', ...$values );
    }


    public function setChecked( bool|string ...$values ) : static {
        return $this->setAttribute( 'checked', ...$values );
    }


    public function setFormNoValidate( bool|string ...$values ) : static {
        return $this->setAttribute( 'formnovalidate', ...$values );
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


    public function setStep( bool|string ...$values ) : static {
        return $this->setAttribute( 'step', ...$values );
    }


    public function size( false|int|null $value ) : static {
        return $this->setSize( is_int( $value ) ? strval( $value ) : false );
    }


    public function step( false|float|int|string|null $value ) : static {
        return $this->setStep( ( is_null( $value ) || false === $value ) ? false : strval( $value ) );
    }


}
