<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Link extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par,
						  ?string $i_nstHref = null,
						  ?string $i_nstRel = null,
						  ?string $i_nstType = null,
						  ... $i_rxChildren ) {
		parent::__construct( $i_par, 'link', ... $i_rxChildren );
		$this->setAlwaysClose( false );
		if ( is_string( $i_nstHref ) )
			$this->setHref( $i_nstHref );
		if ( is_string( $i_nstRel ) )
			$this->setRel( $i_nstRel );
		if ( is_string( $i_nstType ) )
			$this->setType( $i_nstType );
	}


	function setHref( string $i_strHref ) : void {
		$this->setAttribute( 'href', $i_strHref );
	}


	function setRel( string $i_strRel ) : void {
		$this->setAttribute( 'rel', $i_strRel );
	}


	function setSizes( string $i_stSizes ) : void {
		$this->setAttribute( 'sizes', $i_stSizes );
	}


	function setType( string $i_strType ) : void {
		$this->setAttribute( 'type', $i_strType );
	}


}


