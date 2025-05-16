<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


trait AbstractElementTrait {


    abstract public function addAttribute( string $i_stName, string ...$i_rstValues ) : static;


    abstract public function getAttribute( string $i_stName ) : true|string|null;


    abstract public function getAttributeEx( string $i_stName ) : true|string;


    abstract public function hasAttribute( string $i_stName, true|string|null $i_value = null ) : bool;


    abstract public function setAttribute( string $i_stName, bool|string ...$i_values ) : static;


}