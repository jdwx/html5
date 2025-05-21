<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Attributes\ClassTrait;
use JDWX\HTML5\Attributes\IdTrait;
use JDWX\HTML5\Traits\AriaTrait;
use JDWX\HTML5\Traits\AttributeTrait;
use JDWX\HTML5\Traits\ElementListTrait;
use JDWX\HTML5\Traits\GlobalAttributesTrait;
use JDWX\HTML5\Traits\TagTrait;
use JDWX\Web\Stream\StringableStreamTrait;
use Stringable;


class Element implements ElementInterface {


    use AriaTrait;
    use AttributeTrait;
    use ClassTrait;
    use ElementListTrait;
    use GlobalAttributesTrait;
    use IdTrait;
    use StringableStreamTrait;
    use TagTrait;


    protected const string TAG_NAME = 'div';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function __construct( array|string|Stringable $i_children = [] ) {
        $this->setTagName( static::TAG_NAME );
        $this->append( $i_children );
    }


    public static function filterByHasAttribute( string           $i_stAttribute,
                                                 true|string|null $i_value = null ) : callable {
        return fn( $i_el ) => $i_el instanceof Element && $i_el->hasAttribute( $i_stAttribute, $i_value );
    }


    public static function filterByNotHasAttribute( string           $i_stAttribute,
                                                    true|string|null $i_value = null ) : callable {
        return fn( $i_el ) => ! $i_el instanceof Element || ! $i_el->hasAttribute( $i_stAttribute, $i_value );
    }


    public static function filterByNotTagName( string $i_stTagName ) : callable {
        return fn( $i_el ) => ! $i_el instanceof Element || $i_el->getTagName() !== $i_stTagName;
    }


    public static function filterByTagName( string $i_stTagName ) : callable {
        return fn( $i_el ) => $i_el instanceof Element && $i_el->getTagName() === $i_stTagName;
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


    public function getElementById( string $i_stId ) : Element|null {
        return $this->nthChildElementById( $i_stId, 0 );
    }


    public function hasChildren() : bool {
        return 0 < $this->countChildren();
    }


    /** @return iterable<string|Stringable> */
    public function inner() : iterable {
        return $this->children();
    }


    public function nthChildElementByClass( string $i_stClass, int $i_n = 0 ) : Element|null {
        foreach ( $this->childElements( self::filterHasClass( $i_stClass ) ) as $child ) {
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
            assert( $child instanceof Element );
            if ( $child->getAttribute( 'id' ) === $i_stId ) {
                $this->removeChild( $child );
                break;
            }
        }
        return $this;
    }


    public function withParent( Element $i_parent ) : static {
        $i_parent->appendChild( $this );
        return $this;
    }


}
