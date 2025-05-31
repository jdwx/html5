<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


interface ElementListInterface extends StringableListInterface {


    /** @return iterable<ElementInterface> */
    public function childElements( ?callable $i_fnFilter = null ) : iterable;


    public function countChildElements() : int;


    public function nthChildElement( int $i_n ) : ElementInterface|null;


    public function removeNthChildElement( int $i_n = 0 ) : static;


}