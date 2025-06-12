<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\Strict\OK;
use JDWX\Strict\TypeIs;


trait AttributeTrait {


    /** @var array<string, true|string> */
    private array $rAttributes = [];

    /** @var array<string, callable> */
    private array $rAttributeMergers = [];


    /** @suppress PhanTypeMismatchReturn */
    public function addAttribute( string $i_stName, string|true ...$i_values ) : static {
        foreach ( $i_values as $value ) {
            $this->addOneAttribute( $i_stName, $value );
        }
        return $this;
    }


    public function attributeString() : string {
        ksort( $this->rAttributes );
        $st = '';
        foreach ( $this->attrs() as $stKey => $nstValue ) {
            if ( is_string( $nstValue ) ) {
                $st .= ' ' . $stKey . '="' . htmlspecialchars( $nstValue, ENT_QUOTES ) . '"';
            } else {
                $st .= ' ' . $stKey;
            }
        }
        return $st;
    }


    /** @return iterable<string, true|string> */
    public function attrs() : iterable {
        foreach ( $this->rAttributes as $stKey => $bstValue ) {
            yield $stKey => $bstValue;
        }
    }


    public function getAttribute( string $i_stName ) : true|string|null {
        return $this->rAttributes[ $i_stName ] ?? null;
    }


    public function getAttributeEx( string $i_stName ) : true|string {
        $xValue = $this->getAttribute( $i_stName );
        if ( true === $xValue || is_string( $xValue ) ) {
            return $xValue;
        }
        throw new \InvalidArgumentException( "Attribute \"{$i_stName}\" not set" );
    }


    public function getAttributeStringEx( string $i_stName ) : string {
        $xValue = $this->getAttributeEx( $i_stName );
        if ( is_string( $xValue ) ) {
            return $xValue;
        }
        throw new \InvalidArgumentException( "Attribute \"{$i_stName}\" has no value" );
    }


    public function hasAttribute( string $i_stName, true|string|null $i_value = null ) : bool {
        if ( ! isset( $this->rAttributes[ $i_stName ] ) ) {
            return false;
        }
        if ( is_null( $i_value ) ) {
            return true;
        }
        if ( true === $i_value && true === $this->rAttributes[ $i_stName ] ) {
            return true;
        }
        if ( ! is_string( $this->rAttributes[ $i_stName ] ) ) {
            return false;
        }
        $r = OK::preg_split_list( '/\s+/', trim( TypeIs::string( $this->rAttributes[ $i_stName ] ) ) );
        return in_array( $i_value, $r, true );
    }


    public function mergeAttributeValues( string $i_stName, string $i_stValue1, string $i_stValue2 ) : string {
        if ( isset( $this->rAttributeMergers[ $i_stName ] ) ) {
            return $this->rAttributeMergers[ $i_stName ]( $i_stValue1, $i_stValue2 );
        }
        return $i_stValue1 . ' ' . $i_stValue2;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function removeAttribute( string $i_stName, ?string $i_nstValue = null ) : static {
        if ( ! is_string( $i_nstValue ) ) {
            unset( $this->rAttributes[ $i_stName ] );
            return $this;
        }
        if ( empty( $this->rAttributes[ $i_stName ] ) ) {
            return $this;
        }
        $stValue = $this->rAttributes[ $i_stName ];
        /** @phpstan-ignore-next-line */
        assert( is_string( $stValue ) );
        $rValue = OK::preg_split_list( '/\s+/', trim( $stValue ) );
        $rValue = array_diff( $rValue, [ $i_nstValue ] );
        if ( empty( $rValue ) ) {
            unset( $this->rAttributes[ $i_stName ] );
            return $this;
        }
        $this->rAttributes[ $i_stName ] = implode( ' ', $rValue );
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    public function setAttribute( string $i_stName, bool|string ...$i_values ) : static {
        if ( empty( $i_values ) || [ true ] === $i_values ) {
            $this->rAttributes[ $i_stName ] = true;
            return $this;
        }

        if ( [ false ] === $i_values ) {
            $this->removeAttribute( $i_stName );
            return $this;
        }

        $this->rAttributes[ $i_stName ] = join( ' ', $i_values );
        return $this;
    }


    /** @suppress PhanTypeMismatchReturn */
    protected function addAttributeFromBare( string $i_stName, bool|string|null ...$i_values ) : static {
        foreach ( $i_values as $value ) {
            if ( $value === false || $value === null ) {
                $this->removeAttribute( $i_stName );
                continue;
            }
            $this->addOneAttribute( $i_stName, $value );
        }
        return $this;
    }


    protected function addOneAttribute( string $i_stName, string|true $i_value ) : void {
        if ( true === $i_value ) {
            if ( ! isset( $this->rAttributes[ $i_stName ] ) ) {
                $this->rAttributes[ $i_stName ] = true;
            }
            return;
        }
        if ( ! isset( $this->rAttributes[ $i_stName ] ) || true === $this->rAttributes[ $i_stName ] ) {
            $this->rAttributes[ $i_stName ] = $i_value;
            return;
        }
        $this->rAttributes[ $i_stName ] = $this->mergeAttributeValues(
            $i_stName, TypeIs::string( $this->rAttributes[ $i_stName ] ), $i_value
        );
    }


    protected function setAttributeMerger( string $i_stName, callable $i_fnMerger ) : void {
        $this->rAttributeMergers[ $i_stName ] = $i_fnMerger;
    }


}