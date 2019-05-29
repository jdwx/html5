<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


interface IParent {

	function appendChild( ... $i_rxChildren ) : void;
	function getDocument() : IDocument;

}


