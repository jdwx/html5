<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;


use JDWX\HTML5\Element;


class ElementHack extends Element {


	public function renderChild( $i_xChild ) : string {
		return parent::renderChild( $i_xChild );
	}


}


