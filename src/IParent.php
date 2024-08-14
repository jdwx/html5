<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


interface IParent {


    /**
     * @param list<string|Element>|Element|string ...$i_rxChildren
     */
    public function appendChild( array|Element|string ...$i_rxChildren ) : void;


    public function getDocument() : IDocument;


}


