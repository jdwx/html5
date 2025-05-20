<?php /** @noinspection PhpClassNamingConventionInspection */


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\HtmlElement;
use JDWX\HTML5\Traits\TdThTrait;


class Td extends HtmlElement {


    protected const string TAG_NAME = 'td';


    use TdThTrait;
}
