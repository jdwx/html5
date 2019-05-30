<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;


class ElementHack extends \JDWX\HTML5\Element {


	public function renderChild( $i_xChild ) : string {
		return parent::renderChild( $i_xChild );
	}


}


