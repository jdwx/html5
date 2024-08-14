<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class TextArea extends Element {


	public function __construct(IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'textarea', ... $i_rxChildren );
	}


	public function setCols(int $i_iCols ) : void {
		$this->setAttribute( 'cols', ( string ) $i_iCols);
	}


	public function setName(string $i_stName ) : void {
		$this->setAttribute( 'name', $i_stName );
	}


	public function setPlaceHolder(string $i_stPlaceHolder ) : void {
		$this->setAttribute( 'placeholder', $i_stPlaceHolder );
	}

	public function setRows(int $i_iRows ) : void {
		$this->setAttribute( 'rows', ( string ) $i_iRows);
	}


}


