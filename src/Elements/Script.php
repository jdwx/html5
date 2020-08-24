<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Script extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'script', ... $i_rxChildren );
	}


	function setSrc( string $i_stSrc ) : void {
		$this->setAttribute( 'src', $i_stSrc );
	}


}


