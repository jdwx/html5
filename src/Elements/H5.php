<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\ParentInterface;


/** @noinspection PhpClassNamingConventionInspection */
class H5 extends Element {


	public function __construct( ParentInterface $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'h5', ... $i_rxChildren );
	}


}


