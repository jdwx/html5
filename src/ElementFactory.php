<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


require_once __DIR__ . '/Element.php';
require_once __DIR__ . '/IParent.php';


class ElementFactory {


	public static function a( IParent $i_par, ?string $i_nstHref = null,
					   ?string $i_nstTitle = null,
					   ... $i_rxChildren  ) : Elements\A {
		require_once __DIR__ . '/Elements/A.php';
		return new Elements\A( $i_par, $i_nstHref, $i_nstTitle,
							   ... $i_rxChildren );
	}


	public static function aside( IParent $i_par,
						   ... $i_rxChildren ) : Elements\Aside {
		require_once __DIR__ . '/Elements/Aside.php';
		return new Elements\Aside( $i_par, ... $i_rxChildren );
	}


	public static function br( IParent $i_par ) : Elements\Br {
		require_once __DIR__ . '/Elements/Br.php';
		return new Elements\Br( $i_par );
	}


	public static function dd( IParent $i_par, ... $i_rxChildren ) : Elements\Dt {
		require_once __DIR__ . '/Elements/Dd.php';
		return new Elements\Dt( $i_par, ... $i_rxChildren );
	}


	public static function div( IParent $i_par, ... $i_rxChildren ) : Elements\Div {
		require_once __DIR__ . '/Elements/Div.php';
		return new Elements\Div( $i_par, ... $i_rxChildren );
	}


	public static function dl( IParent $i_par, ... $i_rxChildren ) : Elements\Dt {
		require_once __DIR__ . '/Elements/Dl.php';
		return new Elements\Dt( $i_par, ... $i_rxChildren );
	}


	public static function dt( IParent $i_par, ... $i_rxChildren ) : Elements\Dt {
		require_once __DIR__ . '/Elements/Dt.php';
		return new Elements\Dt( $i_par, ... $i_rxChildren );
	}


	public static function footer( IParent $i_par,
							... $i_rxChildren ) : Elements\Footer {
		require_once __DIR__ . '/Elements/Footer.php';
		return new Elements\Footer( $i_par, ... $i_rxChildren );
	}


	public static function form( IParent $i_par, ?string $i_nstAction = null, ?string $i_nstMethod = null,
						         ... $i_rxChildren ) : Elements\Form {
		require_once __DIR__ . '/Elements/Form.php';
		return new Elements\Form( $i_par, $i_nstAction, $i_nstMethod,
								  ... $i_rxChildren );
	}


	public static function header( IParent $i_par, ... $i_rxChildren ) : Elements\Header {
		require_once __DIR__ . '/Elements/Header.php';
		return new Elements\Header( $i_par, ... $i_rxChildren );
	}


	public static function html( IParent $i_par, ... $i_rxChildren ) : Elements\HTML {
		require_once __DIR__ . '/Elements/HTML.php';
		return new Elements\HTML( $i_par, ... $i_rxChildren );
	}


	public static function img( IParent $i_par, ?string $i_nstSrc = null, ... $i_rxChildren ) : Elements\Img {
		require_once __DIR__ . '/Elements/Img.php';
		return new Elements\Img( $i_par, $i_nstSrc, ... $i_rxChildren );
	}


	public static function input( IParent $i_par, ?string $i_nstName = null, ?string $i_nstType = null,
						          ?string $i_nstValue = null, ... $i_rxChildren ) : Elements\Input {
		require_once __DIR__ . '/Elements/Input.php';
		return new Elements\Input( $i_par, $i_nstName, $i_nstType,
                                   $i_nstValue, ... $i_rxChildren );
	}


	public static function li( IParent $i_par, ... $i_rxChildren ) : Elements\Li {
		require_once __DIR__ . '/Elements/Li.php';
		return new Elements\Li( $i_par, ... $i_rxChildren );
	}


	public static function link( IParent $i_par, ?string $i_nstHref = null,
						  ?string $i_nstRel = null, ?string $i_nstType = null,
						  ... $i_rxChildren ) : Elements\Link {
		require_once __DIR__ . '/Elements/Link.php';
		return new Elements\Link( $i_par, $i_nstHref, $i_nstRel, $i_nstType,
								  ... $i_rxChildren );
	}


	public static function main( IParent $i_par, ... $i_rxChildren ) : Elements\Main {
		require_once __DIR__ . '/Elements/Main.php';
		return new Elements\Main( $i_par, ... $i_rxChildren );
	}


	public static function meta( IParent $i_par, ... $i_rxChildren ) : Elements\Meta {
		require_once __DIR__ . '/Elements/Meta.php';
		return new Elements\Meta( $i_par, ... $i_rxChildren );
	}


	public static function nav( IParent $i_par, ... $i_rxChildren ) : Elements\Nav {
		require_once __DIR__ . '/Elements/Nav.php';
		return new Elements\Nav( $i_par, ... $i_rxChildren );
	}


	public static function p( IParent $i_par, ... $i_rxChildren ) : Elements\P {
		require_once __DIR__ . '/Elements/P.php';
		return new Elements\P( $i_par, ... $i_rxChildren );
	}


	public static function section( IParent $i_par, ... $i_rxChildren ) : Elements\Section {
		require_once __DIR__ . '/Elements/Section.php';
		return new Elements\Section( $i_par, ... $i_rxChildren );
	}


	public static function title( IParent $i_par, ... $i_rxChildren ) : Elements\Title {
		require_once __DIR__ . '/Elements/Title.php';
		return new Elements\Title( $i_par, ... $i_rxChildren );
	}


	public static function ul( IParent $i_par, ... $i_rxChildren ) : Elements\Ul {
		require_once __DIR__ . '/Elements/Ul.php';
		return new Elements\Ul( $i_par, ... $i_rxChildren );
	}


}


