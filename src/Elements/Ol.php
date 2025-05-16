<?php declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\Traits\LiTrait;


/** @noinspection PhpClassNamingConventionInspection */


class Ol extends Element {


    protected const string TAG_NAME = 'ol';


    use LiTrait;
}


