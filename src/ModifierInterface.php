<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


interface ModifierInterface extends Stringable {


    public function content() : string|Stringable|null;


    public function modify( ElementInterface $i_element ) : void;


}