<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Elements;


use JDWX\HTML5\Element;
use JDWX\HTML5\IParent;


class HTML extends Element {


    public const DEFAULT_LANG = 'en';


	public function __construct( IParent $i_par, ... $i_rxChildren ) {
		parent::__construct( $i_par, 'html', ... $i_rxChildren );
        $this->setLang( self::DEFAULT_LANG );
	}


}


