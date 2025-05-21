<?php /** @noinspection PhpClassNamingConventionInspection */


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use Stringable;


class Dl extends Element {


    protected const string TAG_NAME = 'dl';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function dd( array|string|Stringable $i_children ) : Dd {
        return ( new Dd( $i_children ) )->withParent( $this );
    }


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function dt( array|string|Stringable $i_children ) : Dt {
        return ( new Dt( $i_children ) )->withParent( $this );
    }


}
