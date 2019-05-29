<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Meta extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'meta', ... $i_rxChildren );
		$this->setAlwaysClose( false );
	}


}


