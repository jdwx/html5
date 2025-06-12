<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


use JDWX\Strict\OK;


require_once __DIR__ . '/TypeGames.php';
require_once __DIR__ . '/TagInfo.php';


class CodeGenerator {


    private const array MAP_TYPE_TO_PARAMETER = [
        'bool' => '?bool',
        'bool|string' => 'bool|string|null',
        'float|int' => 'float|int|false|null',
        'float|int|string' => 'false|float|int|string|null',
        'int' => 'int|false|null',
        'string' => 'false|string|null',
    ];


    /**
     * @param mixed[]|string $i_attrInfo
     * @return array<string, string>
     */
    public static function attributeMethods( string       $stAttrName, string $stAttrTag,
                                             array|string $i_attrInfo, bool $i_bInTrait ) : array {
        $rMethods = [];
        $stAttrMethod = lcfirst( $stAttrName );
        $stAttrName = ucfirst( $stAttrName );
        if ( ! is_array( $i_attrInfo ) ) {
            $i_attrInfo = [ 'type' => $i_attrInfo ];
        }

        $rMethods[ "add{$stAttrName}" ] = CodeGenerator::addAttribute( $stAttrName, $stAttrTag, $i_bInTrait );
        $rMethods[ "get{$stAttrName}" ] = CodeGenerator::getAttribute( $stAttrName, $stAttrTag );
        $rMethods[ "has{$stAttrName}" ] = CodeGenerator::hasAttribute( $stAttrName, $stAttrTag );
        $rMethods[ "set{$stAttrName}" ] = CodeGenerator::setAttribute( $stAttrName, $stAttrTag, $i_bInTrait );
        $rMethods[ $stAttrMethod ] = CodeGenerator::bareAttribute( $stAttrName, $stAttrTag, $stAttrMethod,
            $i_attrInfo, $i_bInTrait );
        if ( $i_attrInfo[ 'withEx' ] ?? false ) {
            $rMethods[ "get{$stAttrName}Ex" ] = CodeGenerator::getExAttribute( $stAttrName, $stAttrTag, $i_attrInfo );
        }
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


    public static function diff( string $i_stFromFile, string $i_stToString ) : void {
        $stTempFile = OK::tempnam( sys_get_temp_dir(), 'html5-element' );
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
            public function {$stFunction}( array|string|Stringable \$i_children = [] ) : {$tag->className()} {
                {$stTrait}return ( new {$tag->className()}( \$i_children ) )->withParent( \$this );
            }
        ZEND
            ) . "\n\n\n";
    }


    public static function updateFile( string $i_stFilename, string $i_stContent, string $i_stName ) : void {
        if ( file_exists( $i_stFilename ) ) {
            $i_stFilename = OK::realpath( $i_stFilename );
            $stExisting = trim( OK::file_get_contents( $i_stFilename ) ) . "\n";
            if ( $stExisting === $i_stContent ) {
                echo "{$i_stFilename} unchanged for {$i_stName}.\n";
                return;
            }
            CodeGenerator::diff( $i_stFilename, $i_stContent );
            /** @noinspection PhpComposerExtensionStubsInspection */
            $x = readline( 'Is this OK? (y/n) ' );
            if ( ! $x || $x[ 0 ] !== 'y' ) {
                echo "Aborted.\n";
                return;
            }
        }
        file_put_contents( $i_stFilename, $i_stContent );
        echo "{$i_stFilename} updated for {$i_stName}.\n";


    }


    private static function addAttribute( string $i_stAttrName, string $i_stAttrTag, bool $i_bInTrait ) : string {
        return self::traitSuppressComment( $i_bInTrait ) . <<<ZEND
            public function add{$i_stAttrName}( string|true ...\$values ) : static {
                return \$this->addAttribute( '{$i_stAttrTag}', ...\$values );
            }
        ZEND;
    }


    /** @param mixed[] $i_attrInfo */
    private static function bareAttribute( string $i_stAttrName, string $i_stAttrTag, string $i_stAttrMethod,
                                           array  $i_attrInfo, bool $i_bInTrait ) : string {
        $bUseAdd = $i_attrInfo[ 'useAdd' ] ?? false;
        if ( $bUseAdd ) {
            return self::bareAttributeAdd( $i_stAttrTag, $i_stAttrMethod, $i_attrInfo, $i_bInTrait );
        }
        return self::bareAttributeSet( $i_stAttrName, $i_stAttrMethod, $i_attrInfo, $i_bInTrait );
    }


    /** @param mixed[] $i_attrInfo */
    private static function bareAttributeAdd( string $i_stAttrTag, string $i_stAttrMethod,
                                              array  $i_attrInfo, bool $i_bInTrait ) : string {
        $stAttrType = strtolower( trim( $i_attrInfo[ 'type' ] ?? '' ) );
        assert( TypeGames::sameType( $stAttrType, 'string|bool' )
            || TypeGames::sameType( $stAttrType, 'string' ) );
        $stAttrType = TypeGames::addType( $stAttrType, 'false' );
        $stAttrType = TypeGames::addType( $stAttrType, 'null' );
        return self::traitSuppressComment( $i_bInTrait ) . <<<ZEND
            public function {$i_stAttrMethod}( {$stAttrType} ...\$values ) : static {
                return \$this->addAttributeFromBare( '{$i_stAttrTag}', ...\$values );
            }

        ZEND;
    }


    /** @param mixed[] $i_attrInfo */
    private static function bareAttributeSet( string       $i_stAttrName, string $i_stAttrMethod,
                                              array|string $i_attrInfo, bool $i_bInTrait ) : string {
        $stDefaultValue = isset( $i_attrInfo[ 'default' ] )
            ? " = {$i_attrInfo[ 'default' ]}"
            : '';
        $stAttrType = strtolower( trim( $i_attrInfo[ 'type' ] ?? '' ) );
        if ( ! ( $stParameterType = self::MAP_TYPE_TO_PARAMETER[ $stAttrType ] ?? null ) ) {
            error_log( "Unknown attribute type {$stAttrType} for parameter." );
            exit( 1 );
        }
        $stParameterType = TypeGames::sortTypes( $stParameterType );
        $stSetCode = self::setCode( 'value', $stParameterType, $i_attrInfo[ 'mapBool' ] ?? false );

        return self::traitSuppressComment( $i_bInTrait ) . <<<ZEND
            public function {$i_stAttrMethod}( {$stParameterType} \$value{$stDefaultValue} ) : static {
                return \$this->set{$i_stAttrName}( {$stSetCode} );
            }

        ZEND;
    }


    private static function getAttribute( string $i_stAttrName, string $i_stAttrTag ) : string {
        return <<<ZEND
            public function get{$i_stAttrName}() : string|true|null {
                return \$this->getAttribute( '{$i_stAttrTag}' );
            }
        ZEND;
    }


    /** @param mixed[] $i_attrInfo */
    private static function getExAttribute( string $i_stAttrName, string $i_stAttrTag, array $i_attrInfo ) : string {
        if ( $i_attrInfo[ 'type' ] == 'string' ) {
            $stReturn = 'string';
            $stMethod = 'getAttributeStringEx';
        } else {
            $stReturn = 'string|true';
            $stMethod = 'getAttributeEx';
        }
        return <<<ZEND
            public function get{$i_stAttrName}Ex() : {$stReturn} {
                return \$this->{$stMethod}( '{$i_stAttrTag}' );
            }
        ZEND;
    }


    private static function hasAttribute( string $i_stAttrName, string $i_stAttrTag ) : string {
        return <<<ZEND
            public function has{$i_stAttrName}( string|true|null \$value = null ) : bool {
                return \$this->hasAttribute( '{$i_stAttrTag}', \$value );
            }
        ZEND;
    }


    private static function setAttribute( string $i_stAttrName, string $i_stAttrTag, bool $i_bInTrait ) : string {
        return self::traitSuppressComment( $i_bInTrait ) . <<<ZEND
            public function set{$i_stAttrName}( bool|string ...\$values ) : static {
                return \$this->setAttribute( '{$i_stAttrTag}', ...\$values );
            }
        ZEND;
    }


    /**
     * @param array<string, mixed>|bool $i_map
     * @noinspection PhpSameParameterValueInspection
     */
    private static function setCode( string $i_stVarName, string $i_stVarType, array|bool $i_map ) : string {
        $stBaseType = TypeGames::removeNull( $i_stVarType );
        $bNullable = TypeGames::isNullable( $i_stVarType );
        if ( 'bool' === $stBaseType || 'bool|string' === $stBaseType ) {
            return self::setCodeBool( $i_stVarName, $i_stVarType, $i_map );
        }

        $stBaseType = TypeGames::removeType( $stBaseType, 'false' );
        $bFalsy = TypeGames::hasType( $i_stVarType, 'false' );
        if ( 'string' === $stBaseType ) {
            if ( $bNullable ) {
                return "\${$i_stVarName} ?? false";
            }
            return "\${$i_stVarName}";
        }
        if ( 'int' === $stBaseType ) {
            if ( $bFalsy ) {
                return "is_int( \${$i_stVarName} ) ? strval( \${$i_stVarName} ) : false";
            }
            if ( $bNullable ) {
                return "\${$i_stVarName} ?? false";
            }
            return "strval( \${$i_stVarName} )";
        }
        if ( 'float|int' === $stBaseType ) {
            if ( $bFalsy ) {
                return "is_int( \${$i_stVarName} ) || is_float( \${$i_stVarName} ) ? strval( \${$i_stVarName} ) : false";
            }
            if ( $bNullable ) {
                return "is_null( \${$i_stVarName} ) ? false : strval( \${$i_stVarName} )";
            }
        }
        if ( 'float|int|string' === $stBaseType ) {
            if ( $bNullable ) {
                if ( $bFalsy ) {
                    return "( is_null( \${$i_stVarName} ) || false === \${$i_stVarName} ) ? false : strval( \${$i_stVarName} )";
                } else {
                    return "is_null( \${$i_stVarName} ) ? false : strval( \${$i_stVarName} )";
                }
            } elseif ( $bFalsy ) {
                return "( false === strval( \${$i_stVarName} ) ) ? false : strval( \${$i_stVarName} )";
            }
            return "strval( \${$i_stVarName} )";
        }
        var_dump( $i_stVarType );
        exit( 1 );
    }


    /** @param array<string, mixed>|bool $i_map */
    private static function setCodeBool( string $i_stVarName, string $i_stVarType, array|bool $i_map ) : string {
        if ( ! $i_map ) {
            if ( TypeGames::isNullable( $i_stVarType ) ) {
                return "\${$i_stVarName} ?? false";
            }
            return "\${$i_stVarName}";
        }
        if ( ! is_array( $i_map ) ) {
            $stIfTrue = "'true'";
            $stIfFalse = "'false'";
        } else {
            $stIfTrue = $i_map[ 'true' ] ?? 'true';
            $stIfFalse = $i_map[ 'false' ] ?? 'false';
        }

        if ( 'bool' === $i_stVarType ) {
            return " \${$i_stVarName} ? {$stIfTrue} : {$stIfFalse}";
        }

        if ( '?bool' === $i_stVarType ) {
            return "is_bool( \${$i_stVarName} ) ? ( \${$i_stVarName} ? {$stIfTrue} : {$stIfFalse} ) : false";
        }

        // ( $i_stVarName ?? false)

        $stResult = "is_bool( \${$i_stVarName} ) ? ( \${$i_stVarName} ? {$stIfTrue} : {$stIfFalse} ) : ";
        if ( TypeGames::isNullable( $i_stVarType ) ) {
            $stResult .= "( \${$i_stVarName} ?? false )";
        } else {
            $stResult .= "\${$i_stVarName}";
        }

        return $stResult;
    }


    private static function traitSuppressComment( bool $i_bInTrait ) : string {
        return $i_bInTrait ? "/** @suppress PhanTypeMismatchReturn */\n" : '';
    }


}
