<?php /** @noinspection PhpClassNamingConventionInspection */


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\Traits\TdThTrait;


class Th extends Element {


    use TdThTrait;


    protected const string TAG_NAME = 'th';


}
