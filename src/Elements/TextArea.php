<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\Traits\FormChildTrait;
use JDWX\HTML5\Traits\PlaceholderTrait;


class TextArea extends Element {


    use FormChildTrait;
    use PlaceholderTrait;


    protected const string TAG_NAME = 'textarea';


    public function cols( int|false|null $i_cols ) : static {
        return $this->setCols( is_int( $i_cols ) ? strval( $i_cols ) : ( $i_cols ?? false ) );
    }


    public function rows( int|false|null $i_rows ) : static {
        return $this->setRows( is_int( $i_rows ) ? strval( $i_rows ) : ( $i_rows ?? false ) );
    }


    public function setCols( bool|string ...$x ) : static {
        return $this->setAttribute( 'cols', ...$x );
    }


    public function setRows( bool|string ...$x ) : static {
        return $this->setAttribute( 'rows', ...$x );
    }


}


