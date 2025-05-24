<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use JDWX\HTML5\Traits\ElementListTrait;
use JDWX\Web\Stream\StringableStreamInterface;
use JDWX\Web\Stream\StringableStreamTrait;
use Stringable;


/**
 * ElementList is useful when you want to pass a chunk of Elements around,
 * but they're not contained by a closing tag.
 */
class ElementList implements ElementListInterface, StringableStreamInterface {


    use ElementListTrait;
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
