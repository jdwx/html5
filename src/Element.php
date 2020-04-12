<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


class Element implements IElement {

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


	function __construct( IParent $i_par, string $i_strTagName,
                          ... $i_rxChildren ) {
		$this->doc = $i_par->getDocument();
		$this->strTagName = $i_strTagName;
		$this->rxChildren = $i_rxChildren;
		if ( $i_par !== $this->doc )
			$i_par->appendChild( $this );
	}


	function __toString() : string {

		$str = '<' . $this->strTagName;

		ksort( $this->rstAttributes );
		foreach ( $this->rstAttributes as $strAttribute => $rxValues ) {

			if ( 1 == count( $rxValues ) && is_bool( $rxValues[ 0 ] ) ) {

				if ( false === $rxValues[ 0 ] )
					continue;

				if ( true === $rxValues [ 0 ] ) {
					$str .= ' ' . $strAttribute;
					continue;
				}

			}
			$str .= ' ' . $strAttribute . '="'
				. $this->doc->escapeValue( join( ' ', $rxValues ) )
				. '"';
		}
		$str .= '>';
		if ( empty( $this->rxChildren ) && ! $this->bAlwaysClose )
			return $str;
		foreach ( $this->rxChildren as $xChild )
			$str .= $this->renderChild( $xChild );
		$str .= '</' . $this->strTagName . '>';
		return $str;
	}


	/** @param string ...$i_rstValues */
	function addAttribute( string $i_strAttribute, ... $i_rstValues ) {

		if ( ! $this->hasAttribute( $i_strAttribute ) ) {
			$this->setAttribute( $i_strAttribute, ... $i_rstValues );
			return;
		}

		foreach ( $i_rstValues as $strValue )
			$this->rstAttributes[ $i_strAttribute ][] = $strValue;

	}


	/** @param string ...$i_rstStyle */
	function addStyle( ... $i_rstStyle ) : void {
		$this->addAttribute( 'style', ... $i_rstStyle );
	}


	function appendChild( ... $i_rxChildren ) : void {
		foreach ( $i_rxChildren as $xChild ) {
			if ( is_array( $xChild ) )
				$this->appendChildren( $xChild );
			else
				$this->rxChildren[] = $xChild;
		}
	}


	function appendChildren( array $i_rxChildren ) : void {
		foreach ( $i_rxChildren as $xChild )
			$this->appendChild( $xChild );
	}


	function clearAttribute( string $i_strAttribute ) : void {
		unset( $this->rstAttributes[ $i_strAttribute ] );
	}


	function dropChildByID( string $i_stID,
							bool $i_bRecursive = false ) : void {
		$rxNew = [];
		foreach ( $this->rxChildren as $xChild ) {
			if ( $xChild instanceOf Element ) {
				if ( $xChild->getID() === $i_stID )
					continue;
				if ( $i_bRecursive )
					$xChild->dropChildByID( $i_stID, true );
			}
			$rxNew[] = $xChild;
		}
		$this->rxChildren = $rxNew;
	}


	function dropChildrenByTagName( string $i_strTagName,
									bool $i_bRecursive = false ) : void {
		$rxNew = [];
		foreach ( $this->rxChildren as $xChild ) {
			if ( $xChild instanceOf Element ) {
				if ( $xChild->strTagName === $i_strTagName )
					continue;
				if ( $i_bRecursive )
					$xChild->dropChildrenByTagName( $i_strTagName, true );
			}
			$rxNew[] = $xChild;
		}
		$this->rxChildren = $rxNew;
	}


	function findChildByID( string $i_stID ) : ?Element {
		foreach ( $this->rxChildren as $xChild )
			if ( $xChild instanceOf Element
					&& $xChild->getID() === $i_stID )
				return $xChild;
		return null;
	}


	function findFirstChildByTagName( string $i_strTagName ) : ?Element {
		foreach ( $this->rxChildren as $xChild )
			if ( $xChild instanceOf Element
					&& $xChild->strTagName === $i_strTagName )
				return $xChild;
		return null;
	}


	function getAttribute( string $i_stAttribute ) : ?string {
		return $this->hasAttribute( $i_stAttribute )
			? join( ' ', $this->rstAttributes[ $i_stAttribute ] )
			: null;
	}


	function getDocument() : IDocument {
		return $this->doc;
	}


	function getID() : ?string {
		$nstID = $this->getAttribute( 'id' );
		return $nstID;
	}


	function hasAttribute( string $i_strAttribute ) : bool {
		return array_key_exists( $i_strAttribute, $this->rstAttributes );
	}


	protected function renderChild( $i_xChild ) : string {
		if ( null === $i_xChild ) {
			trigger_error(
				"Element::renderChild: null child of {$this->strTagName}",
				E_USER_NOTICE
			);
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


	function setAccessKey( string $i_strAccessKey ) : void {
		$this->setAttribute( 'accesskey', $i_strAccessKey );
	}


	/** @param bool|string ...$i_rxValues */
	function setAttribute( string $i_strAttribute, ... $i_rxValues ) : void {
		$this->rstAttributes[ $i_strAttribute ] = [];
		foreach ( $i_rxValues as $strValue )
			$this->rstAttributes[ $i_strAttribute ][] = $strValue;
	}


	/** @param string ...$i_rstClasses */
	function setClass( ... $i_rstClasses ) {
		$this->setAttribute( 'class', ...$i_rstClasses );
	}


	function setContentEditable( bool $i_bContentEditable ) : void {
		$this->setAttribute( 'contenteditable',
							 $i_bContentEditable ? "true" : "false" );
	}


	function setDir( string $i_strDir ) : void {
		$this->setAttribute( 'dir', $i_strDir );
	}


	function setDraggable( $i_xDraggable ) : void {
		if ( is_bool( $i_xDraggable ) ) {
			$this->setAttribute( 'draggable',
								 $i_xDraggable ? "true" : "false" );
			return;
		}
		$this->setAttribute( 'draggable', $i_xDraggable );
	}


	function setHidden( bool $i_bHidden ) : void {
		$this->setAttribute( 'hidden', $i_bHidden );
	}


	function setID( string $i_strID ) : void {
		$this->setAttribute( 'id', $i_strID );
	}


	function setLang( string $i_strLang ) : void {
		$this->setAttribute( 'lang', $i_strLang );
	}


	function setSpellCheck( bool $i_bSpellCheck ) : void {
		$this->setAttribute( 'spellcheck', $i_bSpellCheck ? "true" : "false" );
	}


	function setStyle( ... $i_rstStyle ) : void {
		$this->setAttribute( 'style', ... $i_rstStyle );
	}


	function setTabIndex( int $i_iTabIndex ) : void {
		$this->setAttribute( 'tabindex', strval( $i_iTabIndex ) );
	}


	function setTitle( string $i_strTitle ) : void {
		$this->setAttribute( 'title', $i_strTitle );
	}


	function setTranslate( bool $i_bTranslate ) : void {
		$this->setAttribute( 'translate', $i_bTranslate ? "yes" : "no" );
	}


}


