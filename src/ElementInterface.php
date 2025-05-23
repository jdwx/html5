<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


interface ElementInterface extends AttributeInterface, ElementListInterface, Stringable, TagInterface {


    public function addClass( string|true ...$values ) : static;


    public function addId( string|true ...$values ) : static;


    public function class( false|string|null ...$values ) : static;


    public function getClass() : string|true|null;


    public function getId() : string|true|null;


    public function getIdEx() : string;


    public function hasClass( string|true|null $value = null ) : bool;


    public function hasId( string|true|null $value = null ) : bool;


    public function id( false|string|null $value ) : static;


    public function setClass( bool|string ...$values ) : static;


    public function setId( bool|string ...$values ) : static;


}


