<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


interface HtmlElementInterface extends Stringable {


    public function addClass( string ...$i_rstClass ) : void;


    public function getId() : ?string;


    public function getIdEx() : string;


    public function setClass( ?string ...$i_rstClasses ) : void;


    public function setId( string $i_stId ) : void;


}


