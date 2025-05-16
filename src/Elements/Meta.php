<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;


class Meta extends Element {


    public function __construct( array $i_rChildren ) {
        parent::__construct( 'meta', $i_rChildren );
        $this->setAlwaysClose( false );
    }


    public function charset( string $i_stCharset ) : static {
        return $this->setAttribute( 'charset', $i_stCharset );
    }


    public function setContent( string $i_stContent ) : static {
        return $this->setAttribute( 'content', $i_stContent );
    }


    public function setName( string $i_stName ) : static {
        return $this->setAttribute( 'name', $i_stName );
    }


}


