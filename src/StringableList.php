<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Traits\StringableListTrait;
use JDWX\Web\Stream\StringableStreamTrait;
use Stringable;


class StringableList implements StringableListInterface {


    use StringableListTrait;
    use StringableStreamTrait;


    /**
     * @param iterable<string|Stringable>|string|Stringable $i_children
     * @noinspection PhpDocSignatureInspection
     */
    public function __construct( iterable|string|Stringable $i_children = [] ) {
        $this->append( $i_children );
    }


    /** @return iterable<string|Stringable> */
    public function stream() : iterable {
        yield from $this->children();
    }


}
