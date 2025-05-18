<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/AbstractInfo.php';


class TagInfo extends AbstractInfo {


    protected const string DATA_FILE = __DIR__ . '/element-data.json';


    /** @var mixed[] */
    public static array $rData;


    public function __construct( string $stTagName, bool $i_bMissingIsOK ) {
        parent::__construct( $stTagName, $i_bMissingIsOK );
    }


    public function alwaysClose() : bool {
        return $this->rAttributes[ 'alwaysClose' ] ?? true;
    }


    public function baseClass() : string {
        return $this->rAttributes[ 'baseClass' ] ?? ( $this->alwaysClose() ? 'Element' : 'UnclosedElement' );
    }


    public function className() : string {
        return $this->rAttributes[ 'className' ] ?? ucfirst( $this->stTagName );
    }


    /** @return list<string> */
    public function traits() : array {
        return $this->rAttributes[ 'traits' ] ?? [];
    }


}
