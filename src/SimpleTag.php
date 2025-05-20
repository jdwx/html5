<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Traits\AttributeTrait;
use JDWX\HTML5\Traits\TagTrait;
use Stringable;


class SimpleTag {


    use AttributeTrait;
    use TagTrait;


    public function __construct( string                             $stTagName,
                                 private readonly string|Stringable $stContent ) {
        $this->setTagName( $stTagName );
    }


    protected function inner() : string|Stringable {
        return $this->stContent;
    }


}
