<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Img extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par,
						  ?string $i_nstSrc = null, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'img', $i_rxChildren );
		$this->setAlwaysClose( false );
		if ( is_string( $i_nstSrc ) )
			$this->setSrc( $i_nstSrc );
	}


	function setAlt( string $i_strAlt ) : void {
		$this->setAttribute( 'alt', $i_strAlt );
	}


	function setSrc( string $i_strSrc ) : void {
		$this->setAttribute( 'src', $i_strSrc );
	}


}


