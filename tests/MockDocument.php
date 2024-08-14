<?php


declare( strict_types = 1 );


use JDWX\HTML5\IDocument;


class MockDocument implements IDocument {


    public function appendChild( array|\JDWX\HTML5\Element|string ...$i_rxChildren ) : void {}


    public function escapeValue( string $i_strValue ) : string {
        return $i_strValue;
    }


    public function getDocument() : IDocument {
        return $this;
    }


}



