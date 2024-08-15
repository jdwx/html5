<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


require_once __DIR__ . '/IParent.php';


interface IElement extends IParent, \Stringable {


    public function getId() : ?string;


    public function getIdEx() : string;


    /** Move this element to a new parent. */
    public function reparent( IParent $i_par ) : void;


    public function setClass( ?string ...$i_rstClasses ) : void;


    public function setId( string $i_stId ) : void;


}


