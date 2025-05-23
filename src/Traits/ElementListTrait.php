<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\HTML5\Element;
use JDWX\HTML5\ModifierInterface;
use Stringable;


trait ElementListTrait {


    /** @var list<string|Stringable> */
    private array $rChildren = [];


    /**
     * @param iterable<string|Stringable|iterable<string|Stringable|null>|null>|string|Stringable|null ...$i_children
     * @noinspection PhpDocSignatureInspection
     * @suppress PhanTypeMismatchReturn
     */
    public function append( iterable|string|Stringable|null ...$i_children ) : static {
        foreach ( $i_children as $child ) {
            if ( is_iterable( $child ) ) {
                $this->append( ... $child );
            } else {
                $this->appendChild( $child );
            }
        }
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function appendChild( string|Stringable|null $i_stBody ) : static {
        if ( $i_stBody instanceof ModifierInterface ) {
            $this->handleModifier( $i_stBody );
            return $this->appendChild( $i_stBody->content() );
        }
        if ( ! is_null( $i_stBody ) ) {
            $this->rChildren[] = $i_stBody;
        }
        return $this;
    }


    /** @return iterable<Element> */
    public function childElements( ?callable $i_fnFilter = null ) : iterable {
        foreach ( $this->rChildren as $child ) {
            if ( $child instanceof Element ) {
                if ( ! $i_fnFilter || $i_fnFilter( $child ) ) {
                    yield $child;
                }
            }
        }
    }


    /** @return iterable<string|Stringable> */
    public function children( ?callable $i_fnFilter = null ) : iterable {
        foreach ( $this->rChildren as $child ) {
            if ( ! $i_fnFilter || $i_fnFilter( $child ) ) {
                yield $child;
            }
        }
    }


    public function countChildElements() : int {
        return iterator_count( $this->childElements() );
    }


    public function countChildren() : int {
        return count( $this->rChildren );
    }


    public function hasChildren() : bool {
        return 0 < $this->countChildren();
    }


    public function nthChild( int $i_n ) : string|Stringable|null {
        return $this->rChildren[ $i_n ] ?? null;
    }


    public function nthChildElement( int $i_n ) : Element|null {
        foreach ( $this->rChildren as $child ) {
            if ( $child instanceof Element ) {
                if ( 0 === $i_n ) {
                    return $child;
                }
                $i_n--;
            }
        }
        return null;
    }


    /**
     * There is no prepend() method because it's ambiguous whether
     * prepending multiple elements at the same time should
     * prepend them as a group or individually (the latter reversing
     * the order).
     *
     * @suppress PhanTypeMismatchReturn
     */
    public function prependChild( string|Stringable|null $i_stBody ) : static {
        if ( $i_stBody instanceof ModifierInterface ) {
            $this->handleModifier( $i_stBody );
            return $this->prependChild( $i_stBody->content() );
        }
        if ( ! is_null( $i_stBody ) ) {
            array_unshift( $this->rChildren, $i_stBody );
        }
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function removeAllChildren() : static {
        $this->rChildren = [];
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function removeChild( string|Stringable $i_child ) : static {
        foreach ( $this->rChildren as $i => $child ) {
            if ( $child === $i_child ) {
                unset( $this->rChildren[ $i ] );
                return $this;
            }
        }
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function removeChildren( callable $i_fnCallback ) : static {
        $this->rChildren = array_values( array_filter( $this->rChildren,
            fn( string|Stringable $i_child ) => ! $i_fnCallback( $i_child )
        ) );
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function removeNthChild( int $i_n = 0 ) : static {
        if ( isset( $this->rChildren[ $i_n ] ) ) {
            unset( $this->rChildren[ $i_n ] );
        }
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function removeNthChildElement( int $i_n = 0 ) : static {
        foreach ( $this->rChildren as $i => $child ) {
            if ( $child instanceof Element ) {
                if ( 0 === $i_n ) {
                    unset( $this->rChildren[ $i ] );
                    return $this;
                }
                $i_n--;
            }
        }
        return $this;
    }


    protected function handleModifier( ModifierInterface $i_modifier ) : void {}


}