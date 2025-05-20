<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\HtmlElement;
use Stringable;


class Table extends HtmlElement {


    protected const string TAG_NAME = 'table';


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function tbody( array|string|Stringable $i_children ) : TableBody {
        return ( new TableBody( $i_children ) )->withParent( $this );
    }


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function tfoot( array|string|Stringable $i_children ) : TableFoot {
        return ( new TableFoot( $i_children ) )->withParent( $this );
    }


    /** @param array<string|Stringable>|string|Stringable $i_children */
    public function thead( array|string|Stringable $i_children ) : TableHead {
        return ( new TableHead( $i_children ) )->withParent( $this );
    }


}
