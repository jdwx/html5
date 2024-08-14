<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


require_once __DIR__ . '/IParent.php';


interface IDocument extends IParent {

	public function escapeValue( string $i_stValue ) : string;

}


