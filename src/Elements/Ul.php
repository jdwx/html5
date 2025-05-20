<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Children\ListTrait;
use JDWX\HTML5\HtmlElement;


/** @noinspection PhpClassNamingConventionInspection */


class Ul extends HtmlElement {


    protected const string TAG_NAME = 'ul';


    use ListTrait;
}
