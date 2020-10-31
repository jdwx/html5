<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class Br extends Element {


	public function __construct( IParent $i_par ) {
		parent::__construct( $i_par, 'br' );
		$this->setAlwaysClose( false );
	}

}


