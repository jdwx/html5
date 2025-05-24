<?php /** @noinspection PhpClassNamingConventionInspection */
declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Tr extends Element {


    protected const string TAG_NAME = 'tr';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function td( array|string|Stringable $i_children = [] ) : Td {
        return ( new Td( $i_children ) )->withParent( $this );
    }


    /** @param array<string|Stringable>|string|Stringable|null $i_rx */
    public function tds( array|string|Stringable|null ...$i_rx ) : static {
        Td::zip( $i_rx, $this );
        return $this;
    }


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function th( array|string|Stringable $i_children = [] ) : Th {
        return ( new Th( $i_children ) )->withParent( $this );
    }


    /** @param array<string|Stringable>|string|Stringable|null $i_rx */
    public function ths( array|string|Stringable|null ...$i_rx ) : static {
        Th::zip( $i_rx, $this );
        return $this;
    }


}