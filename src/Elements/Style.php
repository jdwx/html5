<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Style extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'style' );
		if ( ! empty( $i_rxChildren ) )
			$this->appendChild( ... $i_rxChildren );
		$this->setType( "text/css" );
	}


	function setType( string $i_stType ) : void {
		$this->setAttribute( 'type', $i_stType );
	}


}


