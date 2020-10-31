<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


abstract class BaseDocument implements IDocument {


	protected string $stCharset;

	protected string $stEncoding;


	public function __construct( string $i_stCharset = 'utf-8' ) {
		$this->stCharset = $i_stCharset;
		$this->stEncoding = $this->stCharset;
	}


	public function escapeValue( string $i_stValue ) : string {
		return htmlspecialchars( $i_stValue, ENT_COMPAT | ENT_HTML5,
                                 $this->stEncoding );
	}


	public function getDocument() : IDocument {
		return $this;
	}


}


