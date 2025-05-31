<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\HTML5\Element;
use JDWX\HTML5\ModifierInterface;
use Stringable;


trait ElementListTrait {


    use StringableListTrait {
        appendChild as protected appendChildTrait;
        prependChild as protected prependChildTrait;
    }


    public function appendChild( Stringable|string|null $i_child ) : static {
        if ( $i_child instanceof ModifierInterface ) {
            $this->handleModifier( $i_child );
            return $this->appendChild( $i_child->content() );
        }
        return $this->appendChildTrait( $i_child );
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


    public function countChildElements() : int {
        return iterator_count( $this->childElements() );
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


    public function prependChild( Stringable|string|null $i_child ) : static {
        if ( $i_child instanceof ModifierInterface ) {
            $this->handleModifier( $i_child );
            return $this->prependChild( $i_child->content() );
        }
        return $this->prependChildTrait( $i_child );
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


}