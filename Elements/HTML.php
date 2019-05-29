<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class HTML extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'html', ... $i_rxChildren );
	}


}


