<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


trait GlobalAttributesTrait {


    use AbstractElementTrait;


    /** @suppress PhanTypeMismatchReturn */
    public function addAccessKey( string ...$x ) : static {
        return $this->addAttribute( 'accesskey', ...$x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function addClass( string ...$x ) : static {
        return $this->addAttribute( 'class', ...$x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function addStyle( string ...$x ) : static {
        return $this->addAttribute( 'style', ...$x );
    }


    public function getContentEditable() : string|null|true {
        return $this->getAttribute( 'contenteditable' );
    }


    public function getDraggable() : string|null|true {
        return $this->getAttribute( 'draggable' );
    }


    public function getId() : string|null|true {
        return $this->getAttribute( 'id' );
    }


    public function getIdEx() : string {
        $x = $this->getId();
        if ( is_string( $x ) ) {
            return $x;
        }
        throw new \InvalidArgumentException( 'ID not set' );
    }


    public function getTabIndex() : string|null|true {
        return $this->getAttribute( 'tabindex' );
    }


    public function getTitle() : string|null|true {
        return $this->getAttribute( 'title' );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAccessKey( false|string $x ) : static {
        return $this->setAttribute( 'accesskey', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setClass( false|string $x ) : static {
        return $this->setAttribute( 'class', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setContentEditable( bool|string $x ) : static {
        return $this->setAttribute( 'contenteditable', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setDir( bool|string $x ) : static {
        return $this->setAttribute( 'dir', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setDraggable( bool|string $x ) : static {
        return $this->setAttribute( 'draggable', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setHidden( bool|string $x ) : static {
        return $this->setAttribute( 'hidden', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setId( bool|string $x ) : static {
        return $this->setAttribute( 'id', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setLang( bool|string $x ) : static {
        return $this->setAttribute( 'lang', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setSpellCheck( bool|string $x ) : static {
        return $this->setAttribute( 'spellcheck', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setStyle( false|string $x ) : static {
        return $this->setAttribute( 'style', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setTabIndex( false|string $x ) : static {
        return $this->setAttribute( 'tabindex', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setTitle( false|string $x ) : static {
        return $this->setAttribute( 'title', $x );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setTranslate( bool|string $x ) : static {
        return $this->setAttribute( 'translate', $x );
    }


}