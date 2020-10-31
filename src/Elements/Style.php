<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class Style extends Element {


	public function __construct(IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'style' );
		if ( ! empty( $i_rxChildren ) ) {
            $this->appendChild(... $i_rxChildren);
        }
		$this->setType( "text/css" );
	}


	public function setType(string $i_stType ) : void {
		$this->setAttribute( 'type', $i_stType );
	}


}


