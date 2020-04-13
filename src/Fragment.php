<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


class Fragment implements IDocument {


	/** @var Element[] */
	protected $rElements = [];

	/** @var DummyDocument */
	protected $doc;


	public function __construct( string $i_stCharset = 'utf-8' ) {
		$this->doc = new DummyDocument( $i_stCharset );
	}


	public function __toString() : string {
		$st = "";
		foreach ( $this->rElements as $xChild ) {
			$st .= strval( $xChild );
		}
		return $st;
	}


	public function appendChild( ... $i_rxChildren ) : void {
		foreach ( $i_rxChildren as $xChild ) {
			if ( is_array( $xChild ) )
				$this->appendChild( ... $xChild );
			else
				$this->rElements[] = $xChild;
		}
	}


	public function escapeValue( string $i_st ) : string {
		return $this->doc->escapeValue( $i_st );
	}


	public function getDocument() : IDocument {
		return $this->doc;
	}


}


