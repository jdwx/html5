<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


use JDWX\Strict\TypeIs;


final class TypeGames {


    private const array BUILTIN_TYPES = [
        'array', 'bool', 'callable', 'false', 'float', 'int', 'iterable', 'mixed', 'object', 'string', 'true',
    ];


    public static function addType( string $i_stTypes, string $i_stType ) : string {
        $i_stTypes .= "|{$i_stType}";
        return self::sortTypes( $i_stTypes );
    }


    public static function hasType( string $i_stTypes, string $i_stType ) : bool {
        $rTypes = explode( '|', $i_stTypes );
        return in_array( $i_stType, $rTypes, true );
    }


    public static function isFalsy( string $i_stType ) : bool {
        return self::hasType( $i_stType, 'false' ) || self::hasType( $i_stType, 'bool' );
    }


    public static function isNullable( string $i_stTypes ) : bool {
        $i_stTypes = self::sortTypes( $i_stTypes );
        return $i_stTypes !== self::removeNull( $i_stTypes );
    }


    public static function removeNull( string $i_stTypes ) : string {
        $rTypes = [];
        foreach ( explode( '|', $i_stTypes ) as $stType ) {
            if ( 'null' === strtolower( $stType ) ) {
                continue;
            }
            if ( str_starts_with( $stType, '?' ) ) {
                $stType = substr( $stType, 1 );
            }
            $rTypes[] = $stType;
        }
        return self::sortTypes( $rTypes );
    }


    public static function removeType( string $i_stTypes, string $i_stType ) : string {
        if ( 'null' === $i_stType ) {
            return self::removeNull( $i_stTypes );
        }
        if ( 'mixed' === $i_stType ) {
            return 'void';
        }
        if ( str_starts_with( $i_stType, '?' ) ) {
            $i_stType = substr( $i_stType, 1 );
            $i_stTypes = self::removeNull( $i_stTypes );
        }
        $rTypes = explode( '|', $i_stTypes );
        $rTypes = array_diff( $rTypes, [ $i_stType ] );
        if ( 'bool' === $i_stType ) {
            $rTypes = array_diff( $rTypes, [ 'false', 'true' ] );
        }
        if ( 'false' === $i_stType && in_array( 'bool', $rTypes, true ) ) {
            $rTypes = array_diff( $rTypes, [ 'bool' ] );
            $rTypes[] = 'true';
        }
        if ( 'true' === $i_stType && in_array( 'bool', $rTypes, true ) ) {
            $rTypes = array_diff( $rTypes, [ 'bool' ] );
            $rTypes[] = 'false';
        }
        return self::sortTypes( TypeIs::listString( $rTypes ) );
    }


    public static function sameType( string $i_stType1, string $i_stType2 ) : bool {
        $i_stType1 = self::sortTypes( $i_stType1 );
        $i_stType2 = self::sortTypes( $i_stType2 );
        return $i_stType1 === $i_stType2;
    }


    /** @param list<string>|string $i_type */
    public static function sortTypes( array|string $i_type ) : string {
        $rTypes = is_array( $i_type ) ? $i_type : explode( '|', $i_type );
        $rTypes = array_unique( $rTypes );

        # If mixed is present, anything else is irrelevant.
        if ( in_array( 'mixed', $rTypes, true ) ) {
            return 'mixed';
        }

        $bHasNull = in_array( 'null', $rTypes );
        if ( $bHasNull ) {
            $rTypes = array_diff( $rTypes, [ 'null' ] );
        }
        foreach ( $rTypes as & $stType ) {
            if ( str_starts_with( $stType, '?' ) ) {
                $bHasNull = true;
                $stType = substr( $stType, 1 );
            }
        }

        # Consolidate boolean values. (I.e., if true and false both appear, just say bool.)
        if ( in_array( 'false', $rTypes, true ) && in_array( 'true', $rTypes, true ) ) {
            $rTypes = array_diff( $rTypes, [ 'false', 'true' ] );
            $rTypes[] = 'bool';
        }
        if ( in_array( 'false', $rTypes, true ) && in_array( 'bool', $rTypes, true ) ) {
            $rTypes = array_diff( $rTypes, [ 'false' ] );
        }
        if ( in_array( 'true', $rTypes, true ) && in_array( 'bool', $rTypes, true ) ) {
            $rTypes = array_diff( $rTypes, [ 'true' ] );
        }

        # Our canonical order is:
        # 1. Sorted builtin types other than null.
        # 2. Sorted classes/interfaces.
        # 3. Null.
        $rBuiltInMatches = array_intersect( self::BUILTIN_TYPES, $rTypes );
        $rOthers = array_diff( $rTypes, $rBuiltInMatches );
        sort( $rBuiltInMatches );
        sort( $rOthers );
        $rTypes = array_merge( $rBuiltInMatches, $rOthers );
        if ( $bHasNull ) {
            if ( 1 === count( $rTypes ) ) {
                return '?' . $rTypes[ 0 ];
            }
            $rTypes[] = 'null';
        }
        if ( 0 === count( $rTypes ) ) {
            return 'void';
        }
        return implode( '|', $rTypes );
    }


}
