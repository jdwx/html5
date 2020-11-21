<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;


use JDWX\HTML5\IDocument;


class Mockument implements IDocument {


	public function appendChild( ... $i_rxChildren ) : void {
	}


	public function escapeValue( string $i_strValue ) : string {
		return $i_strValue;
	}


	public function getDocument() : IDocument {
		return $this;
	}

}



