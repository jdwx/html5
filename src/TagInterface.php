<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


interface TagInterface {


    public function getAlwaysClose() : bool;


    public function getTagName() : string;


    public function setAlwaysClose( bool $i_bAlwaysClose ) : void;


    public function setTagName( string $i_stTagName ) : void;


    /** @return iterable<string|Stringable> */
    public function stream() : iterable;


}