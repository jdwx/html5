<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Anchor extends Element {


    protected const string TAG_NAME = 'a';


    public function addDownload( string|true ...$values ) : static {
        return $this->addAttribute( 'download', ...$values );
    }


    public function addHref( string|true ...$values ) : static {
        return $this->addAttribute( 'href', ...$values );
    }


    public function addHrefLang( string|true ...$values ) : static {
        return $this->addAttribute( 'hreflang', ...$values );
    }


    public function addMedia( string|true ...$values ) : static {
        return $this->addAttribute( 'media', ...$values );
    }


    public function addPing( string|true ...$values ) : static {
        return $this->addAttribute( 'ping', ...$values );
    }


    public function addRel( string|true ...$values ) : static {
        return $this->addAttribute( 'rel', ...$values );
    }


    public function addTarget( string|true ...$values ) : static {
        return $this->addAttribute( 'target', ...$values );
    }


    public function download( bool|string|null $value ) : static {
        return $this->setDownload( $value ?? false );
    }


    public function getDownload() : string|true|null {
        return $this->getAttribute( 'download' );
    }


    public function getHref() : string|true|null {
        return $this->getAttribute( 'href' );
    }


    public function getHrefLang() : string|true|null {
        return $this->getAttribute( 'hreflang' );
    }


    public function getMedia() : string|true|null {
        return $this->getAttribute( 'media' );
    }


    public function getPing() : string|true|null {
        return $this->getAttribute( 'ping' );
    }


    public function getRel() : string|true|null {
        return $this->getAttribute( 'rel' );
    }


    public function getTarget() : string|true|null {
        return $this->getAttribute( 'target' );
    }


    public function hasDownload( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'download', $value );
    }


    public function hasHref( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'href', $value );
    }


    public function hasHrefLang( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'hreflang', $value );
    }


    public function hasMedia( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'media', $value );
    }


    public function hasPing( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'ping', $value );
    }


    public function hasRel( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'rel', $value );
    }


    public function hasTarget( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'target', $value );
    }


    public function href( false|string|null $value ) : static {
        return $this->setHref( $value ?? false );
    }


    public function hrefLang( false|string|null $value ) : static {
        return $this->setHrefLang( $value ?? false );
    }


    public function media( false|string|null $value ) : static {
        return $this->setMedia( $value ?? false );
    }


    public function ping( false|string|null ...$values ) : static {
        return $this->addAttributeFromBare( 'ping', ...$values );
    }


    public function rel( false|string|null ...$values ) : static {
        return $this->addAttributeFromBare( 'rel', ...$values );
    }


    public function setDownload( bool|string ...$values ) : static {
        return $this->setAttribute( 'download', ...$values );
    }


    public function setHref( bool|string ...$values ) : static {
        return $this->setAttribute( 'href', ...$values );
    }


    public function setHrefLang( bool|string ...$values ) : static {
        return $this->setAttribute( 'hreflang', ...$values );
    }


    public function setMedia( bool|string ...$values ) : static {
        return $this->setAttribute( 'media', ...$values );
    }


    public function setPing( bool|string ...$values ) : static {
        return $this->setAttribute( 'ping', ...$values );
    }


    public function setRel( bool|string ...$values ) : static {
        return $this->setAttribute( 'rel', ...$values );
    }


    public function setTarget( bool|string ...$values ) : static {
        return $this->setAttribute( 'target', ...$values );
    }


    public function target( false|string|null $value ) : static {
        return $this->setTarget( $value ?? false );
    }


}
