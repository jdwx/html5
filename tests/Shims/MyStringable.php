<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Tests\Shims;


use Stringable;


class MyStringable implements Stringable {


    public function __construct( public string $st = '' ) {}


    public function __toString() : string {
        return $this->st;
    }


}
