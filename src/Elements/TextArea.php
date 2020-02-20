<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class TextArea extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'textarea', ... $i_rxChildren );
	}


	function setCols( int $i_iCols ) : void {
		$this->setAttribute( "cols", strval( $i_iCols ) );
	}


	function setRows( int $i_iRows ) : void {
		$this->setAttribute( "rows", strval( $i_iRows ) );
	}


}


