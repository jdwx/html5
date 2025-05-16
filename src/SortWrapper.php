<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


abstract class SortWrapper implements Stringable {


    public function __construct( public string $stSortValue, public string $stContent ) {
    }


}
