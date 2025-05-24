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
        return fn( $i_el ) => $i_el instanceof ElementInterface && $i_el->hasAttribute( $i_stAttribute, $i_value );
    }


    public static function filterByNotHasAttribute( string           $i_stAttribute,
                                                    true|string|null $i_value = null,
                                                    bool             $i_bOnlyElements = false ) : callable {
        if ( $i_bOnlyElements ) {
            return fn( $i_el ) => $i_el instanceof ElementInterface && ! $i_el->hasAttribute( $i_stAttribute, $i_value );
        }
        return fn( $i_el ) => ! $i_el instanceof ElementInterface || ! $i_el->hasAttribute( $i_stAttribute, $i_value );
    }


    public static function filterByNotTagName( string $i_stTagName, bool $i_bOnlyElements = false ) : callable {
        if ( $i_bOnlyElements ) {
            return fn( $i_el ) => $i_el instanceof ElementInterface && $i_el->getTagName() !== $i_stTagName;
        }
        return fn( $i_el ) => ! $i_el instanceof ElementInterface || $i_el->getTagName() !== $i_stTagName;
    }


    public static function filterByTagName( string $i_stTagName ) : callable {
        return fn( $i_el ) => $i_el instanceof ElementInterface && $i_el->getTagName() === $i_stTagName;
    }


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public static function synthetic( string $i_stTagName, array|string|Stringable $i_children = [] ) : static {
        /** @phpstan-ignore-next-line */
        $x = new static( $i_children );
        $x->setTagName( $i_stTagName );
        return $x;
    }


    /** @param iterable<iterable<string|Stringable>|string|Stringable|null> $i_itChildren */
    public static function zip( iterable $i_itChildren, ?ElementListInterface $i_parent = null ) : ElementListInterface {
        $i_parent ??= new ElementList();
        foreach ( $i_itChildren as $child ) {
            $i_parent->append( is_null( $child ) ? new static() : new static( $child ) );
        }
        return $i_parent;
    }


    protected static function filterHasClass( string $i_stClass ) : callable {
        return self::filterByHasAttribute( 'class', $i_stClass );
    }


    protected static function filterHasId( string $i_stId ) : callable {
        return self::filterByHasAttribute( 'id', $i_stId );
    }


    protected static function filterNotHasClass( string $i_stClass, bool $i_bOnlyElements = false ) : callable {
        return self::filterByNotHasAttribute( 'class', $i_stClass, $i_bOnlyElements );
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


    public function getElementById( string $i_stId ) : ElementInterface|null {
        return $this->nthChildElementById( $i_stId, 0 );
    }


    public function handleModifier( ModifierInterface $i_modifier ) : void {
        $i_modifier->modify( $this );
    }


    /** @return iterable<string|Stringable> */
    public function inner() : iterable {
        return $this->children();
    }


    public function nthChildByFilter( callable $i_fnFilter, int $i_n = 0 ) : ElementInterface|null {
        foreach ( $this->childElements( $i_fnFilter ) as $child ) {
            if ( 0 === $i_n ) {
                return $child;
            }
            --$i_n;
        }
        return null;
    }


    public function nthChildElementByClass( string $i_stClass, int $i_n = 0 ) : ElementInterface|null {
        return $this->nthChildByFilter( self::filterHasClass( $i_stClass ), $i_n );
    }


    public function nthChildElementById( string $i_stId, int $i_n ) : ElementInterface|null {
        return $this->nthChildByFilter( self::filterHasId( $i_stId ), $i_n );
    }


    public function nthChildElementByNotClass( string $i_stClass, int $i_n = 0 ) : ElementInterface|null {
        return $this->nthChildByFilter( self::filterNotHasClass( $i_stClass, true ), $i_n );
    }


    public function nthChildElementByNotTagName( string $i_stTagName, int $i_n = 0 ) : ElementInterface {
        return $this->nthChildByFilter( self::filterByNotTagName( $i_stTagName, true ), $i_n );
    }


    public function nthChildElementByTagName( string $i_stTagName, int $i_n = 0 ) : ElementInterface|null {
        return $this->nthChildByFilter( self::filterByTagName( $i_stTagName ), $i_n );
    }


    public function removeChildById( string $i_stId ) : static {
        foreach ( $this->childElements() as $child ) {
            assert( $child instanceof ElementInterface );
            if ( $child->getAttribute( 'id' ) === $i_stId ) {
                $this->removeChild( $child );
                break;
            }
        }
        return $this;
    }


    public function withParent( ElementInterface $i_parent ) : static {
        $i_parent->appendChild( $this );
        return $this;
    }


}
