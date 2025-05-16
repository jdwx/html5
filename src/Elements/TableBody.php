<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\Traits\TableSectionTrait;


class TableBody extends Element {


    protected const string TAG_NAME = 'tbody';


    use TableSectionTrait;
}
