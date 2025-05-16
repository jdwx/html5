<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\ParentInterface;


class Select extends Element {


	public function __construct( ParentInterface $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'select', ... $i_rxChildren );
	}


}


