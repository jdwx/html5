<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class Form extends Element {


	public function __construct(IParent $i_par,
                                ?string $i_nstAction = null,
                                ?string $i_nstMethod = null,
                                ... $i_rxChildren ) {
		parent::__construct( $i_par, 'form', ... $i_rxChildren );
		if ( is_string( $i_nstAction ) ) {
            $this->setAction($i_nstAction);
        }
		if ( is_string( $i_nstMethod ) ) {
            $this->setMethod($i_nstMethod);
        }
	}


	public function setAction(string $i_strAction ) : void {
		$this->setAttribute( 'action', $i_strAction );
	}


	public function setEncType(string $i_stEncType ) : void {
		$this->setAttribute( 'enctype', $i_stEncType );
	}


	public function setMethod(string $i_strMethod ) : void {
		$this->setAttribute( 'method', $i_strMethod );
	}


}


