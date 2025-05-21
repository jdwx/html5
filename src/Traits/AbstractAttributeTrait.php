<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


/**
 * This is used by individual attribute implementations to define the
 * underlying interface they rely on, since traits cannot require or
 * implement interfaces.
 */
trait AbstractAttributeTrait {


    abstract public function addAttribute( string $i_stName, string ...$i_rstValues ) : static;


    abstract public function getAttribute( string $i_stName ) : string|true|null;


    abstract public function getAttributeEx( string $i_stName ) : string|true;


    abstract public function getAttributeStringEx( string $i_stName ) : string;


    abstract public function hasAttribute( string $i_stName, string|true|null $i_value = null ) : bool;


    abstract public function setAttribute( string $i_stName, bool|string ...$i_values ) : static;


    abstract protected function addAttributeFromBare( string $i_stName, bool|string|null ...$i_values ) : static;


}