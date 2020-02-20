<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Option extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'option', ... $i_rxChildren );
	}


	function setValue( string $i_stValue ) : void {
		$this->setAttribute( 'value', $i_stValue );
	}


}


