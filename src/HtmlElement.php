<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Traits\AriaTrait;
use JDWX\HTML5\Traits\GlobalAttributesTrait;
use Stringable;


class HtmlElement extends Element {


    use AriaTrait;
    use GlobalAttributesTrait;


    protected const string TAG_NAME = 'div';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function __construct( array|string|Stringable $i_children = [] ) {
        parent::__construct( static::TAG_NAME, $i_children );
    }


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public static function synthetic( string $i_stTagName, array|string|Stringable $i_children = [] ) : static {
        /** @phpstan-ignore-next-line */
        $x = new static( $i_children );
        $x->setTagName( $i_stTagName );
        return $x;
    }


    protected static function filterHasClass( string $i_stClass ) : callable {
        return self::filterByHasAttribute( 'class', $i_stClass );
    }


    protected static function filterNotHasClass( string $i_stClass ) : callable {
        return self::filterByNotHasAttribute( 'class', $i_stClass );
    }


    /** Adds one or more classes to (direct) child elements of the current element. */
    public function addChildClasses( ?string ...$x ) : static {
        foreach ( $this->childElements() as $child ) {
            $st = array_shift( $x );
            if ( is_string( $st ) ) {
                $child->class( $st );
            }
        }
        return $this;
    }


    public function addClass( bool|string ...$values ) : static {
        return $this->addAttribute( 'class', ...$values );
    }


    public function appendChildElement( HtmlElement $x ) : HtmlElement {
        $this->appendChild( $x );
        return $x;
    }


    /** @return iterable<HtmlElement> */
    public function childElements( ?callable $i_fnFilter = null ) : iterable {
        /** @phpstan-ignore-next-line */
        yield from parent::childElements();
    }


    public function class( string ...$x ) : static {
        return $this->addClass( ... $x );
    }


    public function getElementById( string $i_stId ) : HtmlElement|null {
        return $this->nthChildElementById( $i_stId, 0 );
    }


    public function getId() : string|true|null {
        return $this->getAttribute( 'id' );
    }


    public function getIdEx() : string {
        $value = $this->getId();
        if ( is_string( $value ) ) {
            return $value;
        }
        throw new \InvalidArgumentException( 'ID not set' );
    }


    public function hasChildren() : bool {
        return 0 < $this->countChildren();
    }


    public function hasClass( string|true|null $value = null ) : bool {
        return $this->hasAttribute( 'class', $value );
    }


    public function id( string $x ) : static {
        return $this->setId( $x );
    }


    public function nthChildElement( int $i_n, ?callable $i_fnFilter = null ) : HtmlElement|null {
        $nel = Element::nthChildElement( $i_n );
        assert( $nel instanceof HtmlElement || null === $nel );
        return $nel;
    }


    public function nthChildElementByClass( string $i_stClass, int $i_n = 0 ) : HtmlElement|null {
        foreach ( $this->childElements( self::filterHasClass( $i_stClass ) ) as $child ) {
            assert( $child instanceof HtmlElement );
            if ( $child->hasAttribute( 'class', $i_stClass ) ) {
                if ( 0 === $i_n ) {
                    return $child;
                }
                --$i_n;
            }
        }
        return null;
    }


    public function nthChildElementById( string $i_stId, int $i_n ) : HtmlElement|null {
        foreach ( $this->childElements() as $child ) {
            assert( $child instanceof HtmlElement );
            if ( $child->getAttribute( 'id' ) === $i_stId ) {
                if ( 0 === $i_n ) {
                    return $child;
                }
                --$i_n;
            }
        }
        return null;
    }


    public function nthChildElementByTagName( string $i_stTag, int $i_n = 0 ) : HtmlElement|null {
        foreach ( $this->childElements() as $child ) {
            assert( $child instanceof HtmlElement );
            if ( $child->getTagName() === $i_stTag ) {
                if ( 0 === $i_n ) {
                    return $child;
                }
                --$i_n;
            }
        }
        return null;
    }


    public function removeChildById( string $i_stId ) : static {
        foreach ( $this->childElements() as $child ) {
            assert( $child instanceof Element );
            if ( $child->getAttribute( 'id' ) === $i_stId ) {
                $this->removeChild( $child );
                break;
            }
        }
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setClass( bool|string ...$values ) : static {
        return $this->setAttribute( 'class', ...$values );
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setId( bool|string ...$values ) : static {
        return $this->setAttribute( 'id', ...$values );
    }


}
