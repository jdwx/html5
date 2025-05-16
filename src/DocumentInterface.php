<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


interface DocumentInterface extends ParentInterface {

	public function escapeValue( string $i_stValue ) : string;

}


