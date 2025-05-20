<?php /** @noinspection PhpClassNamingConventionInspection */


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\HtmlElement;
use JDWX\HTML5\Traits\TdThTrait;


class Th extends HtmlElement {


    protected const string TAG_NAME = 'th';


    use TdThTrait;
}
