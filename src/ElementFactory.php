<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Elements\Anchor;
use JDWX\HTML5\Elements\Table;
use JDWX\HTML5\Elements\TableBody;
use JDWX\HTML5\Elements\TableFoot;
use JDWX\HTML5\Elements\TableHead;
use JDWX\HTML5\Elements\Td;
use JDWX\HTML5\Elements\Th;
use JDWX\HTML5\Elements\Tr;
use Stringable;


final class ElementFactory {


    /** @deprecated */
    public static function make( string            $i_strType,
                                 string|Stringable ...$i_rxChildren ) : Anchor|Tr|Td|Table|TableBody|Element {

        return match ( $i_strType ) {
            'a' => new Anchor( $i_rxChildren ),
            'table' => new Table( $i_rxChildren ),
            'tbody' => new TableBody( $i_rxChildren ),
            'td' => new Td( $i_rxChildren ),
            'tfoot' => new TableFoot( $i_rxChildren ),
            'th' => new Th( $i_rxChildren ),
            'thead' => new TableHead( $i_rxChildren ),
            'tr' => new Tr( $i_rxChildren ),
            default => Element::synthetic( $i_strType, $i_rxChildren ),
        };

    }


}
