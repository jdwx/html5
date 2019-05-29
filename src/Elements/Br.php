<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Br extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par ) {
		parent::__construct( $i_par, 'br' );
		$this->setAlwaysClose( false );
	}

}


