<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Children\ListTrait;
use JDWX\HTML5\HtmlElement;


/** @noinspection PhpClassNamingConventionInspection */


class Ol extends HtmlElement {


    protected const string TAG_NAME = 'ol';


    use ListTrait;
}


