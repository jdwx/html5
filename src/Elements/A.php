<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class A extends Element {


	public function __construct( IParent $i_par, ?string $i_nstHref = null, ?string $i_nstTitle = null,
						         ... $i_rxChildren ) {
		parent::__construct( $i_par, 'a', ... $i_rxChildren );
		if ( is_string( $i_nstHref ) ) {
            $this->setHref($i_nstHref);
        }
		if ( is_string( $i_nstTitle ) ) {
            $this->setTitle($i_nstTitle);
        }
	}


	/** @param string ...$i_rstrPing */
	public function addPing( ... $i_rstrPing ) : void {
		$this->addAttribute( 'ping', ... $i_rstrPing ); 
	}


	/** @param string ...$i_rstrRel */
	public function addRel( ...  $i_rstrRel ) : void {
		$this->addAttribute( 'rel', ... $i_rstrRel );
	}


	/** @param bool|string $i_xDownload */
	public function setDownload( $i_xDownload ) : void {
		if ( is_bool( $i_xDownload ) && ! $i_xDownload ) {
			$this->clearAttribute( 'download' );
			return;
		}
		$this->setAttribute( 'download', $i_xDownload );
	}


	public function setHref( string $i_strHref ) : void {
		$this->setAttribute( 'href', $i_strHref );
	}


	public function setHrefLang( string $i_strHrefLang ) : void {
		$this->setAttribute( 'hreflang', $i_strHrefLang );
	}


	public function setMedia( string $i_strMedia ) : void {
		$this->setAttribute( 'media', $i_strMedia );
	}


	/** @param string ...$i_rstrPing */
	public function setPing( ... $i_rstrPing ) : void {
		$this->setAttribute( 'ping', ... $i_rstrPing );
	}


	/** @param string ...$i_rstrRel */
	public function setRel( ... $i_rstrRel ) : void {
		$this->setAttribute( 'rel', ... $i_rstrRel );
	}


	public function setTarget( string $i_strTarget ) : void {
		$this->setAttribute( 'target', $i_strTarget );
	}


}


