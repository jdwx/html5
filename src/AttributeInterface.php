<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


interface AttributeInterface {


    public function addAttribute( string $i_stName, string|true ...$i_values ) : static;


    public function attributeString() : string;


    /** @return iterable<string, string> */
    public function attrs() : iterable;


    public function getAttribute( string $i_stName ) : true|string|null;


    public function getAttributeEx( string $i_stName ) : true|string;


    public function getAttributeStringEx( string $i_stName ) : string;


    public function hasAttribute( string $i_stName, true|string|null $i_value = null ) : bool;


    public function removeAttribute( string $i_stName, ?string $i_nstValue = null ) : static;


    public function setAttribute( string $i_stName, bool|string ...$i_values ) : static;


}