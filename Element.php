<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


require_once __DIR__ . '/IDocument.php';


class Element {

	/** @var string */
	protected $strTagName;

	/** @var array */
	protected $rstAttributes = [];

	/** @var array */
	protected $rxChildren;

	/** @var bool */
	protected $bAlwaysClose = true;

	/** @var IDocument */
	protected $doc;


	function __construct( IDocument $i_doc, string $i_strTagName,
                          ... $i_rxChildren ) {
		$this->doc = $i_doc;
		$this->strTagName = $i_strTagName;
		$this->rxChildren = $i_rxChildren;
	}


	function __toString() : string {
		$str = '<' . $this->strTagName;
		ksort( $this->rstAttributes );
		foreach ( $this->rstAttributes as $strAttribute => $rstValues )
			$str .= ' ' . $strAttribute . '="'
				. $this->doc->escapeValue( join( ' ', $rstValues ) )
				. '"';
		$str .= '>';
		if ( empty( $this->rxChildren ) && ! $this->bAlwaysClose )
			return $str;
		foreach ( $this->rxChildren as $xChild )
			$str .= $this->renderChild( $xChild );
		$str .= '</' . $this->strTagName . '>';
		return $str;
	}


	/** @param string ...$i_rstrValues */
	function addAttribute( string $i_strAttribute, ... $i_rstrValues )
																	 : Element {

		if ( ! array_key_exists( $i_strAttribute, $this->rstAttributes ) )
			return $this->setAttribute( $i_strAttribute, ... $i_rstrValues );

		foreach ( $i_rstrValues as $strValue )
			$this->rstAttributes[ $i_strAttribute ][] = $strValue;

		return $this;

	}


	function appendChild( ... $i_rxChildren ) : Element {
		foreach ( $i_rxChildren as $xChild )
			$this->rxChildren[] = $xChild;
		return $this;
	}


	function clearAttribute( $i_strAttribute ) : Element {
		unset( $this->rstAttributes[ $i_strAttribute ] );
		return $this;
	}


	protected function renderChild( $i_xChild ) : string {
		if ( null === $i_xChild ) {
			trigger_error( "Element::renderChild: null child", E_USER_NOTICE );
			return '';
		}
		if ( is_string( $i_xChild ) )
			return $i_xChild;
		if ( is_int( $i_xChild ) )
			return strval( $i_xChild );
		if ( is_float( $i_xChild ) )
			return strval( $i_xChild );
		if ( is_bool( $i_xChild ) )
			return $i_xChild ? "true" : "false";
		if ( is_object( $i_xChild ) )
			return $i_xChild->__toString();
		if ( is_array( $i_xChild ) ) {
			$str = '';
			foreach ( $i_xChild as $xChild )
				$str .= $this->renderChild( $xChild );
			return $str;
		}
		throw new \Exception( "I don't know what this child is: "
							  . gettype( $i_xChild ) );
	}


	function setAlwaysClose( bool $i_bAlwaysClose ) : void {
		$this->bAlwaysClose = $i_bAlwaysClose;
	}


	/** @param string ...$i_rstValues */
	function setAttribute( string $i_strAttribute, ... $i_rstValues )
                                                                     : Element {
		$this->rstAttributes[ $i_strAttribute ] = [];
		foreach ( $i_rstValues as $strValue )
			$this->rstAttributes[ $i_strAttribute ][] = $strValue;
		return $this;
	}


	/** @param string ...$i_rstClasses */
	function setClass( ... $i_rstClasses ) : Element {
		return $this->setAttribute( 'class', ...$i_rstClasses );
	}


	function setID( string $i_strID ) : Element {
		return $this->setAttribute( 'id', $i_strID );
	}


}


