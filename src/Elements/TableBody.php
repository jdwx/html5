<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Children\TableSectionTrait;
use JDWX\HTML5\Element;


class TableBody extends Element {


    protected const string TAG_NAME = 'tbody';


    use TableSectionTrait;
}
