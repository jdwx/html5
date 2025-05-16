<?php


declare( strict_types = 1 );


use JDWX\HTML5\DocumentInterface;


class MockDocument implements DocumentInterface {


    public function appendChild( array|\JDWX\HTML5\Element|string ...$i_rxChildren ) : void {}


    public function escapeValue( string $i_strValue ) : string {
        return $i_strValue;
    }


    public function getDocument() : DocumentInterface {
        return $this;
    }


}



