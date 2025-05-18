<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/TagInfo.php';


class Generator {


    private const array MAP_TYPE_TO_PARAMETER = [
        'bool' => '?bool',
        'bool|string' => 'bool|string|null',
        'float|int' => 'float|int|false|null',
        'int' => 'int|false|null',
        'string' => 'string|false|null',
    ];

    private const array MAP_TYPE_TO_SET_CODE  = [
        'bool' => '$value ?? false',
        'bool|string' => '$value ?? false',
        'float|int' => 'is_int( $value ) || is_float( $value ) ? strval( $value ) : false',
        'int' => 'is_int( $value ) ? strval( $value ) : false',
        'string' => '$value ?? false',
    ];


    public static function addAttribute( string $i_stAttrName, string $i_stAttrTag, bool $i_bInTrait ) : string {
        return self::traitSuppressComment( $i_bInTrait ) . <<<ZEND
            public function add{$i_stAttrName}( bool|string ...\$values ) : static {
                return \$this->addAttribute( '{$i_stAttrTag}', ...\$values );
            }
        ZEND;
    }


    /**
     * @param mixed[]|string $i_attrInfo
     * @return array<string, string>
     */
    public static function attributeMethods( string       $stAttrName, string $stAttrTag,
                                             array|string $i_attrInfo, bool $i_bInTrait ) : array {
        $rMethods = [];
        $stAttrMethod = lcfirst( $stAttrName );
        $stAttrName = ucfirst( $stAttrName );

        $rMethods[ "add{$stAttrName}" ] = Generator::addAttribute( $stAttrName, $stAttrTag, $i_bInTrait );
        $rMethods[ "get{$stAttrName}" ] = Generator::getAttribute( $stAttrName, $stAttrTag );
        $rMethods[ "has{$stAttrName}" ] = Generator::hasAttribute( $stAttrName, $stAttrTag );
        $rMethods[ "set{$stAttrName}" ] = Generator::setAttribute( $stAttrName, $stAttrTag, $i_bInTrait );
        $rMethods[ $stAttrMethod ] = Generator::bareAttribute( $stAttrName, $stAttrMethod,
            $i_attrInfo, $i_bInTrait );
        return $rMethods;
    }


    /** @return array<string, string> */
    public static function attributeMethodsList( AbstractInfo $info, bool $i_bInTrait ) : array {
        $rMethods = [];
        foreach ( $info->attributes() as $stAttrTag => $rAttrInfo ) {
            $stAttrName = $info::kebabToCamel( $stAttrTag );
            $stAttrTag = strtolower( $stAttrTag );
            $rMethods += self::attributeMethods( $stAttrName, $stAttrTag, $rAttrInfo, $i_bInTrait );
        }
        return $rMethods;
    }


    /** @param mixed[]|string $i_attrInfo */
    public static function bareAttribute( string       $i_stAttrName, string $i_stAttrMethod,
                                          array|string $i_attrInfo, bool $i_bInTrait ) : string {
        if ( ! is_array( $i_attrInfo ) ) {
            $i_attrInfo = [ 'type' => $i_attrInfo ];
        }
        $stDefaultValue = isset( $i_attrInfo[ 'default' ] )
            ? " = {$i_attrInfo[ 'default' ]}"
            : '';
        $bUseAdd = $i_attrInfo[ 'useAdd' ] ?? false;
        $stAdd = $bUseAdd ? 'add' : 'set';
        $stAttrType = strtolower( trim( $i_attrInfo[ 'type' ] ?? '' ) );
        if ( ! ( $stParameterType = self::MAP_TYPE_TO_PARAMETER[ $stAttrType ] ?? null ) ) {
            error_log( "Unknown attribute type {$stAttrType} for parameter." );
            exit( 1 );
        }
        if ( ! ( $stSetCode = self::MAP_TYPE_TO_SET_CODE[ $stAttrType ] ?? null ) ) {
            error_log( "Unknown attribute type {$stAttrType} for code." );
            exit( 1 );
        }
        if ( $i_attrInfo[ 'mapBool' ] ?? null ) {
            if ( $i_attrInfo[ 'mapBool' ] === true ) {
                $i_attrInfo[ 'mapBool' ] = [ 'true' => 'true', 'false' => 'false' ];
            }
            $stTrue = isset( $i_attrInfo[ 'mapBool' ][ 'true' ] )
                ? "'{$i_attrInfo[ 'mapBool' ][ 'true' ]}'"
                : 'true';
            $stFalse = isset( $i_attrInfo[ 'mapBool' ][ 'false' ] )
                ? "'{$i_attrInfo[ 'mapBool' ][ 'false' ]}'"
                : 'false';
            $stSetCode = "is_bool( \$value ) ? ( \$value ? {$stTrue} : {$stFalse} ) : ";
            if ( $stAttrType === 'bool' ) {
                $stSetCode .= 'false';
            } else {
                $stSetCode .= "( \$value ?? false )";
            }
        }

        return self::traitSuppressComment( $i_bInTrait ) . <<<ZEND
            public function {$i_stAttrMethod}( {$stParameterType} \$value{$stDefaultValue} ) : static {
                return \$this->{$stAdd}{$i_stAttrName}( {$stSetCode} );
            }

        ZEND;
    }


    public static function diff( string $i_stFromFile, string $i_stToString ) : void {
        $stTempFile = tempnam( sys_get_temp_dir(), 'html5-element' );
        file_put_contents( $stTempFile, $i_stToString );
        $stDiff = escapeshellcmd( 'diff' ) . ' --color=always -u ' . escapeshellarg( $i_stFromFile )
            . ' ' . escapeshellarg( $stTempFile );
        passthru( $stDiff );
        unlink( $stTempFile );
    }


    public static function generateChild( string $i_stTagName, bool $i_bInTrait ) : string {
        $tag = new TagInfo( $i_stTagName, true );
        $stTrait = $i_bInTrait ? "assert( \$this instanceof Element );\n        " : '';
        $stFunction = lcfirst( $tag->name() );
        return '    ' . trim( <<<ZEND
            /** @param array<string|Stringable>|string|Stringable \$i_children */
            public function {$stFunction}( array|string|Stringable \$i_children ) : {$tag->className()} {
                {$stTrait}return ( new {$tag->className()}( \$i_children ) )->withParent( \$this );
            }
        ZEND
            ) . "\n\n\n";
    }


    public static function getAttribute( string $i_stAttrName, string $i_stAttrTag ) : string {
        return <<<ZEND
            public function get{$i_stAttrName}() : string|true|null {
                return \$this->getAttribute( '{$i_stAttrTag}' );
            }
        ZEND;
    }


    public static function hasAttribute( string $i_stAttrName, string $i_stAttrTag ) : string {
        return <<<ZEND
            public function has{$i_stAttrName}( string|true|null \$value = null ) : bool {
                return \$this->hasAttribute( '{$i_stAttrTag}', \$value );
            }
        ZEND;
    }


    public static function setAttribute( string $i_stAttrName, string $i_stAttrTag, bool $i_bInTrait ) : string {
        return self::traitSuppressComment( $i_bInTrait ) . <<<ZEND
            public function set{$i_stAttrName}( bool|string ...\$values ) : static {
                return \$this->setAttribute( '{$i_stAttrTag}', ...\$values );
            }
        ZEND;
    }


    public static function updateFile( string $i_stFilename, string $i_stContent, string $i_stName ) : void {
        if ( file_exists( $i_stFilename ) ) {
            $i_stFilename = realpath( $i_stFilename );
            $stExisting = trim( file_get_contents( $i_stFilename ) ) . "\n";
            if ( $stExisting === $i_stContent ) {
                echo "{$i_stFilename} unchanged for {$i_stName}.\n";
                return;
            }
            Generator::diff( $i_stFilename, $i_stContent );
            /** @noinspection PhpComposerExtensionStubsInspection */
            $x = readline( 'Is this OK? (y/n) ' );
            if ( ! $x || $x[ 0 ] !== 'y' ) {
                echo "Aborted.\n";
                exit( 1 );
            }
        }
        file_put_contents( $i_stFilename, $i_stContent );
        echo "{$i_stFilename} updated for {$i_stName}.\n";


    }


    private static function traitSuppressComment( bool $i_bInTrait ) : string {
        return $i_bInTrait ? "/** @suppress PhanTypeMismatchReturn */\n" : '';
    }


}
