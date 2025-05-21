<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Anchor extends Element {


    protected const string TAG_NAME = 'a';


    public function addDownload( bool|string ...$values ) : static {
        return $this->addAttribute( 'download', ...$values );
    }


    public function addHref( bool|string ...$values ) : static {
        return $this->addAttribute( 'href', ...$values );
    }


    public function addHrefLang( bool|string ...$values ) : static {
        return $this->addAttribute( 'hreflang', ...$values );
    }


    public function addMedia( bool|string ...$values ) : static {
        return $this->addAttribute( 'media', ...$values );
    }


    public function addPing( bool|string ...$values ) : static {
        return $this->addAttribute( 'ping', ...$values );
    }


    public function addRel( bool|string ...$values ) : static {
        return $this->addAttribute( 'rel', ...$values );
    }


    public function addTarget( bool|string ...$values ) : static {
        return $this->addAttribute( 'target', ...$values );
    }


    public function download( bool|string|null $value ) : static {
        return $this->setDownload( $value ?? false );
    }


    public function getDownload() : bool|string|null {
        return $this->getAttribute( 'download' );
    }


    public function getHref() : bool|string|null {
        return $this->getAttribute( 'href' );
    }


    public function getHrefLang() : bool|string|null {
        return $this->getAttribute( 'hreflang' );
    }


    public function getMedia() : bool|string|null {
        return $this->getAttribute( 'media' );
    }


    public function getPing() : bool|string|null {
        return $this->getAttribute( 'ping' );
    }


    public function getRel() : bool|string|null {
        return $this->getAttribute( 'rel' );
    }


    public function getTarget() : bool|string|null {
        return $this->getAttribute( 'target' );
    }


    public function hasDownload( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'download', $value );
    }


    public function hasHref( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'href', $value );
    }


    public function hasHrefLang( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'hreflang', $value );
    }


    public function hasMedia( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'media', $value );
    }


    public function hasPing( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'ping', $value );
    }


    public function hasRel( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'rel', $value );
    }


    public function hasTarget( bool|string|null $value = null ) : bool {
        return $this->hasAttribute( 'target', $value );
    }


    public function href( string|false|null $value ) : static {
        return $this->setHref( $value ?? false );
    }


    public function hrefLang( string|false|null $value ) : static {
        return $this->setHrefLang( $value ?? false );
    }


    public function media( string|false|null $value ) : static {
        return $this->setMedia( $value ?? false );
    }


    public function ping( string|false|null $value ) : static {
        return $this->addPing( $value ?? false );
    }


    public function rel( string|false|null $value ) : static {
        return $this->addRel( $value ?? false );
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


    public function target( string|false|null $value ) : static {
        return $this->setTarget( $value ?? false );
    }


}
