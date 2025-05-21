<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


use JDWX\Json\Json;


class AbstractInfo {


    protected const string DATA_FILE = '/dev/null';


    /** @var mixed[] */
    public array $rAttributes = [];

    public string $stTagName;

    public string $stTag;


    /** @suppress PhanUndeclaredStaticProperty */
    public function __construct( string  $i_stTagName, bool $i_bMissingIsOK,
                                 ?string $i_nstDefaultField = null ) {
        self::load();
        $stClass = preg_replace( '/^.*\\\/', '', static::class );
        $stTagNameCheck = strtolower( static::kebabToCamel( $i_stTagName ) );
        $rData = null;
        /** @phpstan-ignore staticProperty.notFound */
        foreach ( static::$rData as $stTagNameRef => $rDataRef ) {
            $stTagNameRefCheck = static::kebabToCamel( $stTagNameRef );
            if ( strtolower( $stTagNameRefCheck ) === $stTagNameCheck ) {
                $this->stTagName = $stTagNameRefCheck;
                $this->stTag = strtolower( $stTagNameRef );
                $rData = $rDataRef;
                break;
            }
        }
        if ( ! isset( $this->stTagName ) ) {
            error_log( "WARNING: No {$stClass} data for {$i_stTagName}." );
            if ( ! $i_bMissingIsOK ) {
                exit( 1 );
            }
            return;
        }
        if ( is_array( $rData ) ) {
            $this->rAttributes = $rData;
            return;
        }
        if ( true === $rData ) {
            # Accept all defaults.
            return;
        }
        if ( is_string( $i_nstDefaultField ) ) {
            $this->rAttributes = [ $i_nstDefaultField => $rData ];
            return;
        }
        throw new \RuntimeException(
            "WARNING: Bad {$stClass} data for {$this->stTagName}: " . print_r( $rData, true )
        );
    }


    public static function kebabToCamel( string $stKebab ) : string {
        return str_replace( '-', '', ucwords( $stKebab, '-' ) );

    }


    /**
     * @suppress PhanUndeclaredStaticProperty
     */
    protected static function load() : void {
        /** @phpstan-ignore staticProperty.notFound */
        if ( ! isset( static::$rData ) ) {
            /** @phpstan-ignore staticProperty.notFound */
            static::$rData = Json::fromFile( static::DATA_FILE );
        }
    }


    /** @return mixed[] */
    public function all() : array {
        return $this->rAttributes;
    }


    /** @return mixed[] */
    public function attributes() : array {
        return $this->rAttributes[ 'attributes' ] ?? [];
    }


    /** @return mixed[] */
    public function children() : array {
        return $this->rAttributes[ 'children' ] ?? [];
    }


    public function hasAttributes() : bool {
        return count( $this->attributes() ) > 0;
    }


    public function hasChildren() : bool {
        return count( $this->children() ) > 0;
    }


    public function name() : string {
        return $this->stTagName;
    }


    public function tag() : string {
        return $this->stTag;
    }


}
