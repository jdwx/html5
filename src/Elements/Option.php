<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\DisabledTrait;
use JDWX\HTML5\Attributes\RequiredTrait;
use JDWX\HTML5\Attributes\ValueTrait;
use JDWX\HTML5\Element;


class Option extends Element {


    use DisabledTrait;
    use RequiredTrait;
    use ValueTrait;


    protected const string TAG_NAME = 'option';


    public function addMultiple( string|true ...$values ) : static {
        return $this->addAttribute( 'multiple', ...$values );
    }


    public function addSelected( string|true ...$values ) : static {
        return $this->addAttribute( 'selected', ...$values );
    }


    public function getMultiple() : string|true|null {
        return $this->getAttribute( 'multiple' );
    }


    public function getSelected() : string|true|null {
        return $this->getAttribute( 'selected' );
    }


    public function hasMultiple( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'multiple', $value );
    }


    public function hasSelected( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'selected', $value );
    }


    public function multiple( ?bool $value ) : static {
        return $this->setMultiple( $value ?? false );
    }


    public function selected( ?bool $value ) : static {
        return $this->setSelected( $value ?? false );
    }


    public function setMultiple( bool|string ...$values ) : static {
        return $this->setAttribute( 'multiple', ...$values );
    }


    public function setSelected( bool|string ...$values ) : static {
        return $this->setAttribute( 'selected', ...$values );
    }


}
