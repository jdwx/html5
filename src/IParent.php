<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


interface IParent {

	public function appendChild( ... $i_rxChildren ) : void;
	public function getDocument() : IDocument;

}


