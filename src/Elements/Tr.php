<?php /** @noinspection PhpClassNamingConventionInspection */
declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\SortWrapper;
use Stringable;


class Tr extends Element {


    protected const string TAG_NAME = 'tr';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function td( array|string|Stringable $i_children ) : Td {
        return ( new Td( $i_children ) )->withParent( $this );
    }


    /** @param array<string|Stringable>|string|Stringable|null $i_rx */
    public function tds( array|string|Stringable|null ...$i_rx ) : static {
        foreach ( $i_rx as $x ) {
            if ( is_array( $x ) ) {
                $this->td( $x );
            } elseif ( $x instanceof SortWrapper ) {
                $td = $this->td( $x->stContent );
                $td->addAttribute( 'sort-value', $x->stSortValue );
            } else {
                $this->td( strval( $x ) );
            }
        }
        return $this;
    }


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function th( array|string|Stringable $i_children ) : Th {
        return ( new Th( $i_children ) )->withParent( $this );
    }


    /** @param array<string|Stringable>|string|Stringable|null $i_rx */
    public function ths( array|string|Stringable|null ...$i_rx ) : static {
        foreach ( $i_rx as $x ) {
            if ( is_array( $x ) ) {
                $this->th( $x );
            } else {
                $this->th( $x );
            }
        }
        return $this;
    }


}