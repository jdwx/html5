<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Traits\AriaTrait;
use JDWX\HTML5\Traits\GlobalAttributesTrait;
use Stringable;


class Element extends \JDWX\Web\Panels\Element {


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


    public function appendChildElement( Element $x ) : Element {
        $this->appendChild( $x );
        return $x;
    }


    /** @return iterable<Element> */
    public function childElements( ?callable $i_fnFilter = null ) : iterable {
        /** @phpstan-ignore-next-line */
        yield from parent::childElements();
    }


    public function class( string ...$x ) : static {
        return $this->addClass( ... $x );
    }


    public function contentEditable( bool|string|null $i_bContentEditable = true ) : static {
        return $this->setContentEditable(
            is_bool( $i_bContentEditable )
                ? ( $i_bContentEditable ? 'true' : 'false' )
                : ( $i_bContentEditable ?? false )
        );
    }


    public function draggable( ?bool $i_bDraggable = true ) : static {
        return $this->setDraggable(
            is_bool( $i_bDraggable )
                ? ( $i_bDraggable ? 'true' : 'false' )
                : false
        );
    }


    public function getElementById( string $i_stId ) : Element|null {
        return $this->nthChildElementById( $i_stId, 0 );
    }


    public function hasChildren() : bool {
        return 0 < $this->countChildren();
    }


    public function hidden( bool $i_bHidden = true ) : static {
        return $this->setHidden( $i_bHidden );
    }


    public function id( string $x ) : static {
        return $this->setId( $x );
    }


    public function lang( string $x ) : static {
        return $this->setAttribute( 'lang', $x );
    }


    public function nthChildElement( int $i_n, ?callable $i_fnFilter = null ) : Element|null {
        $nel = \JDWX\Web\Panels\Element::nthChildElement( $i_n );
        assert( $nel instanceof Element || null === $nel );
        return $nel;
    }


    public function nthChildElementByClass( string $i_stClass, int $i_n = 0 ) : Element|null {
        foreach ( $this->childElements( self::filterHasClass( $i_stClass ) ) as $child ) {
            /** @phpstan-ignore-next-line */
            assert( $child instanceof Element );
            if ( $child->hasAttribute( 'class', $i_stClass ) ) {
                if ( 0 === $i_n ) {
                    return $child;
                }
                --$i_n;
            }
        }
        return null;
    }


    public function nthChildElementById( string $i_stId, int $i_n ) : Element|null {
        foreach ( $this->childElements() as $child ) {
            /** @phpstan-ignore-next-line */
            assert( $child instanceof Element );
            if ( $child->getAttribute( 'id' ) === $i_stId ) {
                if ( 0 === $i_n ) {
                    return $child;
                }
                --$i_n;
            }
        }
        return null;
    }


    public function nthChildElementByTagName( string $i_stTag, int $i_n = 0 ) : Element|null {
        foreach ( $this->childElements() as $child ) {
            /** @phpstan-ignore-next-line */
            assert( $child instanceof Element );
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
            /** @phpstan-ignore-next-line */
            assert( $child instanceof Element );
            if ( $child->getAttribute( 'id' ) === $i_stId ) {
                $this->removeChild( $child );
                break;
            }
        }
        return $this;
    }


    public function spellCheck( ?bool $i_bSpellCheck = true ) : static {
        return $this->setSpellCheck( is_bool( $i_bSpellCheck ) ? ( $i_bSpellCheck ? 'true' : 'false' ) : false );
    }


    public function tabIndex( ?int $i_nIndex ) : static {
        return $this->setTabIndex( is_int( $i_nIndex ) ? strval( $i_nIndex ) : false );
    }


    public function title( string $x ) : static {
        return $this->setTitle( $x );
    }


    public function translate( ?bool $i_bTranslate = true ) : static {
        return $this->setTranslate( is_bool( $i_bTranslate ) ? ( $i_bTranslate ? 'yes' : 'no' ) : false );
    }


    public function withParent( Element $i_parent ) : static {
        $i_parent->appendChild( $this );
        return $this;
    }


}
