<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


/** @noinspection PhpClassNamingConventionInspection */
class Dt extends Element {


	public function __construct(IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'dt' );
		if ( ! empty( $i_rxChildren ) ) {
            $this->appendChild(... $i_rxChildren);
        }
	}


}


