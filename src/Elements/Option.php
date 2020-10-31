<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class Option extends Element {


	public function __construct(IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'option', ... $i_rxChildren );
	}


	public function setValue(string $i_stValue ) : void {
		$this->setAttribute( 'value', $i_stValue );
	}


}


