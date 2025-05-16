<?php /** @noinspection PhpClassNamingConventionInspection */
declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\SortWrapper;
use Stringable;


class Tr extends Element {


    public function __construct( Stringable|array|string $i_body = [] ) {
        parent::__construct( 'tr', $i_body );
    }


    public function td( ...$x ) : TdTh {
        return ( new TdTh( 'td', ... $x ) )->withParent( $this );
    }


    public function tds( string|Stringable|SortWrapper|array|null ...$i_rx ) : static {
        foreach ( $i_rx as $x ) {
            if ( is_array( $x ) ) {
                $this->td( ... $x );
            } elseif ( $x instanceof SortWrapper ) {
                $td = $this->td( $x->stContent );
                $td->addAttribute( 'sort-value', $x->stSortValue );
            } else {
                $this->td( strval( $x ) );
            }
        }
        return $this;
    }


    public function th( ...$x ) : TdTh {
        return ( new TdTh( 'th', ... $x ) )->withParent( $this );
    }


    public function ths( ...$i_rx ) : static {
        foreach ( $i_rx as $x ) {
            if ( is_array( $x ) ) {
                $this->th( ... $x );
            } else {
                $this->th( $x );
            }
        }
        return $this;
    }


}