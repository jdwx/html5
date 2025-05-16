<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


class Element extends \JDWX\Web\Panels\Element {


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


    public function addStyle( string ...$x ) : static {
        return $this->addAttribute( 'style', ...$x );
    }


    public function appendChildElement( Element $x ) : Element {
        $this->appendChild( $x );
        return $x;
    }


    /** @return iterable<Element> */
    public function childElements( ?callable $i_fnFilter = null ) : iterable {
        yield from parent::childElements();
    }


    public function class( string ...$x ) : static {
        return $this->addAttribute( 'class', ...$x );
    }


    public function getElementById( string $i_stId ) : Element|null {
        return $this->nthChildElementById( $i_stId, 0 );
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


    public function hidden( bool $i_bHidden = true ) : static {
        return $this->setAttribute( 'hidden', $i_bHidden );
    }


    public function id( string $x ) : static {
        return $this->setAttribute( 'id', $x );
    }


    public function lang( string $x ) : static {
        return $this->setAttribute( 'lang', $x );
    }


    public function nthChildElement( int $i_n ) : Element|null {
        $nel = \JDWX\Web\Panels\Element::nthChildElement( $i_n );
        assert( $nel instanceof Element || null === $nel );
        return $nel;
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


    public function setClass( false|string $x ) : static {
        return $this->setAttribute( 'class', $x );
    }


    public function setStyle( string $x ) : static {
        return $this->setAttribute( 'style', $x );
    }


    public function title( string $x ) : static {
        return $this->setAttribute( 'title', $x );
    }


    public function withParent( Element $i_parent ) : static {
        $i_parent->appendChild( $this );
        return $this;
    }


}