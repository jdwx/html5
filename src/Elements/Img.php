<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class Img extends Element {


    public function __construct( IParent $i_par,
                                 ?string $i_nstSrc = null, ...$i_rxChildren ) {
        parent::__construct( $i_par, 'img', $i_rxChildren );
        $this->setAlwaysClose( false );
        if ( is_string( $i_nstSrc ) ) {
            $this->setSrc( $i_nstSrc );
        }
    }


    public function setAlt( string $i_strAlt ): void {
        $this->setAttribute( 'alt', $i_strAlt );
    }


    public function setSrc( string $i_strSrc ): void {
        $this->setAttribute( 'src', $i_strSrc );
    }


}


