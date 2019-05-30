<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;


class Mockument implements \JDWX\HTML5\IDocument {


	function appendChild( ... $i_rxChildren ) : void {
	}


	function escapeValue( string $i_strValue ) : string {
		return $i_strValue;
	}


	function getDocument() : \JDWX\HTML5\IDocument {
		return $this;
	}

}



