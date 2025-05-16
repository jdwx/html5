<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\Traits\LiTrait;


/** @noinspection PhpClassNamingConventionInspection */


class Ul extends Element {


    protected const string TAG_NAME = 'ul';


    use LiTrait;
}
