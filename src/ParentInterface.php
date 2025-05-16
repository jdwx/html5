<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


interface ParentInterface {


    /**
     * @param list<string|Element>|Element|string ...$i_rxChildren
     * @noinspection PhpDocSignatureInspection
     */
    public function append( array|Element|string ...$i_rxChildren ) : void;


    public function getDocument() : DocumentInterface;


}


