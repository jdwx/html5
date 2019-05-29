<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


class A extends \JDWX\HTML5\Element {


	function __construct( \JDWX\HTML5\IParent $i_par,
						  ?string $i_nstHref = null, ?string $i_nstTitle = null,
						  ... $i_rxChildren ) {
		parent::__construct( $i_par, 'a', ... $i_rxChildren );
		if ( is_string( $i_nstHref ) )
			$this->setHref( $i_nstHref );
		if ( is_string( $i_nstTitle ) )
			$this->setTitle( $i_nstTitle );
	}


	/** @param string ...$i_rstrPing */
	function addPing( ... $i_rstrPing ) : void {
		$this->addAttribute( 'ping', ... $i_rstrPing ); 
	}


	/** @param string ...$i_rstrRel */
	function addRel( ...  $i_rstrRel ) : void {
		$this->addAttribute( 'rel', ... $i_rstrRel );
	}


	/** @var bool|string $i_xDownload */
	function setDownload( $i_xDownload ) : void {
		if ( is_bool( $i_xDownload ) && ! $i_xDownload ) {
			$this->clearAttribute( 'download' );
			return;
		}
		$this->setAttribute( 'download', $i_xDownload );
	}


	function setHref( string $i_strHref ) : void {
		$this->setAttribute( 'href', $i_strHref );
	}


	function setHrefLang( string $i_strHrefLang ) : void {
		$this->setAttribute( 'hreflang', $i_strHrefLang );
	}


	function setMedia( string $i_strMedia ) : void {
		$this->setAttribute( 'media', $i_strMedia );
	}


	/** @param string ...$i_rstrPing */
	function setPing( ... $i_rstrPing ) : void {
		$this->setAttribute( 'ping', ... $i_rstrPing );
	}


	/** @param string ...$i_rstrRel */
	function setRel( ... $i_rstrRel ) : void {
		$this->setAttribute( 'rel', ... $i_rstrRel );
	}


	function setTarget( string $i_strTarget ) : void {
		$this->setAttribute( 'target', $i_strTarget );
	}


}


