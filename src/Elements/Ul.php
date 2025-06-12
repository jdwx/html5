<?php /** @noinspection PhpClassNamingConventionInspection */


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Attributes\TypeTrait;
use JDWX\HTML5\Children\ListTrait;
use JDWX\HTML5\Element;


class Ul extends Element {


    use ListTrait;
    use TypeTrait;


    protected const string TAG_NAME = 'ul';


}
