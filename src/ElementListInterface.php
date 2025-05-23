<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


interface ElementListInterface {


    /**
     * @param iterable<string|Stringable|iterable<string|Stringable|null>|null>|string|Stringable|null ...$i_children
     * @noinspection PhpDocSignatureInspection
     * @suppress PhanTypeMismatchReturn
     */
    public function append( iterable|string|Stringable|null ...$i_children ) : static;


    public function appendChild( string|Stringable|null $i_stBody ) : static;


    /** @return iterable<ElementInterface> */
    public function childElements( ?callable $i_fnFilter = null ) : iterable;


    /** @return iterable<string|Stringable> */
    public function children( ?callable $i_fnFilter = null ) : iterable;


    public function countChildElements() : int;


    public function countChildren() : int;


    public function hasChildren() : bool;


    public function nthChild( int $i_n ) : string|Stringable|null;


    public function nthChildElement( int $i_n ) : ElementInterface|null;


    public function prependChild( string|Stringable|null $i_stBody ) : static;


    public function removeAllChildren() : static;


    public function removeChild( string|Stringable $i_child ) : static;


    public function removeChildren( callable $i_fnCallback ) : static;


    public function removeNthChild( int $i_n = 0 ) : static;


    public function removeNthChildElement( int $i_n = 0 ) : static;


}