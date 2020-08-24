<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class Input extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par,
						  ?string $i_nstName = null,
						  ?string $i_nstType = null,
						  ?string $i_nstValue = null,
 						  ... $i_rxChildren ) {
		parent::__construct( $i_par, 'input', ... $i_rxChildren );
		$this->setAlwaysClose( false );
		if ( is_string( $i_nstName ) )
			$this->setName( $i_nstName );
		if ( is_string( $i_nstType ) )
			$this->setType( $i_nstType );
		if ( is_string( $i_nstValue ) )
			$this->setValue( $i_nstValue );
	}


	function setChecked( bool $i_bChecked ) : void {
		$this->setAttribute( 'checked', $i_bChecked );
	}


	function setMaxLength( int $i_iMaxLength ) : void {
		$this->setAttribute( 'maxlength', strval( $i_iMaxLength ) );
	}


	function setName( string $i_strName ) : void {
		$this->setAttribute( 'name', $i_strName );
	}


	function setPlaceHolder( string $i_strPlaceHolder ) : void {
		$this->setAttribute( 'placeholder', $i_strPlaceHolder );
	}


	function setSize( int $i_iCols ) : void {
		$this->setAttribute( 'size', strval( $i_iCols ) );
	}

	function setType( string $i_strType ) : void {
		$this->setAttribute( 'type', $i_strType );
	}


	function setValue( string $i_strValue ) : void {
		$this->setAttribute( 'value', $i_strValue );
	}


}


