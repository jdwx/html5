<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\ValueTrait;
use JDWX\HTML5\Element;


class Option extends Element {


    use ValueTrait;


    protected const string TAG_NAME = 'option';


}
