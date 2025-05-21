<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Children\TableSectionTrait;
use JDWX\HTML5\Element;


class TableHead extends Element {


    use TableSectionTrait;


    protected const string TAG_NAME = 'thead';


}
