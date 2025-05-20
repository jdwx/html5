<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Children\TableSectionTrait;
use JDWX\HTML5\HtmlElement;


class TableHead extends HtmlElement {


    protected const string TAG_NAME = 'thead';

    use TableSectionTrait;
}
