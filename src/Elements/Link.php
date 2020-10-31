<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class Link extends Element {


	public function __construct(IParent $i_par,
                                ?string $i_nstHref = null,
                                ?string $i_nstRel = null,
                                ?string $i_nstType = null,
                                ... $i_rxChildren ) {
		parent::__construct( $i_par, 'link', ... $i_rxChildren );
		$this->setAlwaysClose( false );
		if ( is_string( $i_nstHref ) ) {
            $this->setHref($i_nstHref);
        }
		if ( is_string( $i_nstRel ) ) {
            $this->setRel($i_nstRel);
        }
		if ( is_string( $i_nstType ) ) {
            $this->setType($i_nstType);
        }
	}


	public function setHref(string $i_strHref ) : void {
		$this->setAttribute( 'href', $i_strHref );
	}


	public function setRel(string $i_strRel ) : void {
		$this->setAttribute( 'rel', $i_strRel );
	}


	public function setSizes(string $i_stSizes ) : void {
		$this->setAttribute( 'sizes', $i_stSizes );
	}


	public function setType(string $i_strType ) : void {
		$this->setAttribute( 'type', $i_strType );
	}


}


