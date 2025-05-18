<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/AbstractInfo.php';


class TraitInfo extends AbstractInfo {


    protected const string DATA_FILE = __DIR__ . '/trait-data.json';

    /** @var mixed[] */
    public static array $rData;


    public function __construct( ?string $stTagName, bool $i_bMissingIsOK, ?string $i_nstDefaultField = null ) {
        if ( ! is_string( $stTagName ) ) {
            error_log( 'No trait name' );
            exit( 1 );
        }
        if ( str_ends_with( $stTagName, 'Trait' ) ) {
            $stTagName = substr( $stTagName, 0, -5 );
        }
        parent::__construct( $stTagName, $i_bMissingIsOK, $i_nstDefaultField );
    }


    public function trait() : string {
        return $this->name() . 'Trait';
    }


}