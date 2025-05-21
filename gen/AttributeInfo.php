<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/TraitInfo.php';


class AttributeInfo extends TraitInfo {


    protected const string DATA_FILE = __DIR__ . '/attribute-data.json';

    /** @var mixed[] */
    public static array $rData;


    public function __construct( ?string $stTagName, bool $i_bMissingIsOK ) {
        parent::__construct( $stTagName, $i_bMissingIsOK, 'type' );
    }


    public function attrName() : string {
        return lcfirst( $this->stTagName );
    }


}
