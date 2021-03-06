<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use InvalidArgumentException;

class Element implements IElement {


	protected string $strTagName;

	protected array $rstAttributes = [];

	protected array $rxChildren;

	protected bool $bAlwaysClose = true;

	protected IDocument $doc;


	public function __construct( IParent $i_par, string $i_strTagName, ... $i_rxChildren ) {
		$this->doc = $i_par->getDocument();
		$this->strTagName = $i_strTagName;
		$this->rxChildren = $i_rxChildren;
		if ( $i_par !== $this->doc ) {
            $i_par->appendChild( $this );
        }
	}


	public function __toString() : string {

		$str = '<' . $this->strTagName;

		ksort( $this->rstAttributes );
		foreach ( $this->rstAttributes as $strAttribute => $rxValues ) {

			if ( 1 === count( $rxValues ) && is_bool( $rxValues[ 0 ] ) ) {

				if ( false === $rxValues[ 0 ] ) {
                    continue;
                }

				if ( true === $rxValues [ 0 ] ) {
					$str .= ' ' . $strAttribute;
					continue;
				}

			}
			$str .= ' ' . $strAttribute . '="'
				. $this->doc->escapeValue( implode( ' ', $rxValues ) )
				. '"';
		}
		$str .= '>';
		if ( empty( $this->rxChildren ) && ! $this->bAlwaysClose ) {
            return $str;
        }
		foreach ( $this->rxChildren as $xChild ) {
            $str .= $this->renderChild($xChild);
        }
		$str .= '</' . $this->strTagName . '>';
		return $str;
	}


    /**
     * @param string $i_strAttribute
     * @param string ...$i_rstValues
     */
	public function addAttribute( string $i_strAttribute, ... $i_rstValues ) : void {

		if ( ! $this->hasAttribute( $i_strAttribute ) ) {
			$this->setAttribute( $i_strAttribute, ... $i_rstValues );
			return;
		}

		foreach ( $i_rstValues as $strValue ) {
            $this->rstAttributes[$i_strAttribute][] = $strValue;
        }

	}


	/** @param string ...$i_rstClass */
	public function addClass( ... $i_rstClass ) : void {
		$this->addAttribute( 'class', ... $i_rstClass );
	}


	/** @param string ...$i_rstStyle */
	public function addStyle( ... $i_rstStyle ) : void {
		$this->addAttribute( 'style', ... $i_rstStyle );
	}


	public function appendChild( ... $i_rxChildren ) : void {
		foreach ( $i_rxChildren as $xChild ) {
			if ( is_array( $xChild ) ) {
                $this->appendChildren($xChild);
            }
			else {
                $this->rxChildren[] = $xChild;
            }
		}
	}


	public function appendChildren( array $i_rxChildren ) : void {
		foreach ( $i_rxChildren as $xChild ) {
            $this->appendChild($xChild);
        }
	}


	public function clearAttribute( string $i_strAttribute ) : void {
		unset( $this->rstAttributes[ $i_strAttribute ] );
	}


	public function countChildren() : int {
	    return count( $this->rxChildren );
    }


	public function dropChildByID( string $i_stID, bool $i_bRecursive = false ) : void {
		$rxNew = [];
		foreach ( $this->rxChildren as $xChild ) {
			if ( $xChild instanceOf self ) {
				if ( $xChild->getID() === $i_stID ) {
                    continue;
                }
				if ( $i_bRecursive ) {
                    $xChild->dropChildByID($i_stID, true);
                }
			}
			$rxNew[] = $xChild;
		}
		$this->rxChildren = $rxNew;
	}


	public function dropChildrenByTagName( string $i_strTagName, bool $i_bRecursive = false ) : void {
		$rxNew = [];
		foreach ( $this->rxChildren as $xChild ) {
			if ( $xChild instanceOf self ) {
				if ( $xChild->strTagName === $i_strTagName ) {
                    continue;
                }
				if ( $i_bRecursive ) {
                    $xChild->dropChildrenByTagName($i_strTagName, true);
                }
			}
			$rxNew[] = $xChild;
		}
		$this->rxChildren = $rxNew;
	}


	public function findChildByID( string $i_stID ) : ?Element {
		foreach ( $this->rxChildren as $xChild ) {
            if ($xChild instanceof self
                && $xChild->getID() === $i_stID) {
                return $xChild;
            }
        }
		return null;
	}


	public function findFirstChildByTagName( string $i_strTagName ) : ?Element {
		foreach ( $this->rxChildren as $xChild ) {
            if ($xChild instanceof self
                && $xChild->strTagName === $i_strTagName) {
                return $xChild;
            }
        }
		return null;
	}


	public function getAlwaysClose() : bool {
	    return $this->bAlwaysClose;
    }


	public function getAttribute( string $i_stAttribute ) : ?string {
		return $this->hasAttribute( $i_stAttribute )
			? implode( ' ', $this->rstAttributes[ $i_stAttribute ] )
			: null;
	}


	public function getDocument() : IDocument {
		return $this->doc;
	}


	public function getID() : ?string {
        return $this->getAttribute( 'id' );
	}


	public function hasAttribute( string $i_strAttribute ) : bool {
		return array_key_exists( $i_strAttribute, $this->rstAttributes );
	}


	public function hasChildren() : bool {
	    return $this->countChildren() > 0;
    }


	protected function renderChild( $i_xChild ) : string {
		if ( null === $i_xChild ) {
			trigger_error(
				"Element::renderChild: null child of {$this->strTagName}",
				E_USER_NOTICE
			);
			return '';
		}
		if ( is_string( $i_xChild ) ) {
            return $i_xChild;
        }
		if ( is_int( $i_xChild ) ) {
            return ( string )$i_xChild;
        }
		if ( is_float( $i_xChild ) ) {
            return ( string )$i_xChild;
        }
		if ( is_bool( $i_xChild ) ) {
            return $i_xChild ? "true" : "false";
        }
		if ( is_object( $i_xChild ) ) {
            return $i_xChild->__toString();
        }
		if ( is_array( $i_xChild ) ) {
			$str = '';
			foreach ( $i_xChild as $xChild ) {
                $str .= $this->renderChild($xChild);
            }
			return $str;
		}
		throw new InvalidArgumentException( "I don't know what this child is: " . gettype( $i_xChild ) );
	}


	public function setAlwaysClose( bool $i_bAlwaysClose ) : void {
		$this->bAlwaysClose = $i_bAlwaysClose;
	}


	public function setAccessKey( string $i_strAccessKey ) : void {
		$this->setAttribute( 'accesskey', $i_strAccessKey );
	}


	/** @param string ...$i_rstLabel */
	public function setAriaLabel( ... $i_rstLabel ) : void {
		$this->setAttribute( 'aria-label', ... $i_rstLabel );
	}


    /**
     * @param string $i_strAttribute
     * @param bool|string ...$i_rxValues
     */
	public function setAttribute( string $i_strAttribute, ... $i_rxValues ) : void {
		$this->rstAttributes[ $i_strAttribute ] = [];
		foreach ( $i_rxValues as $strValue ) {
            $this->rstAttributes[$i_strAttribute][] = $strValue;
        }
	}


	/** @param string ...$i_rstClasses */
	public function setClass( ... $i_rstClasses ) : void {
		$this->setAttribute( 'class', ...$i_rstClasses );
	}


	public function setContentEditable( bool $i_bContentEditable ) : void {
		$this->setAttribute( 'contenteditable',
							 $i_bContentEditable ? "true" : "false" );
	}


	public function setDir( string $i_strDir ) : void {
		$this->setAttribute( 'dir', $i_strDir );
	}


	public function setDraggable( $i_xDraggable ) : void {
		if ( is_bool( $i_xDraggable ) ) {
			$this->setAttribute( 'draggable',
								 $i_xDraggable ? "true" : "false" );
			return;
		}
		$this->setAttribute( 'draggable', $i_xDraggable );
	}


	public function setHidden( bool $i_bHidden ) : void {
		$this->setAttribute( 'hidden', $i_bHidden );
	}


	public function setID( string $i_strID ) : void {
		$this->setAttribute( 'id', $i_strID );
	}


	public function setLang( string $i_strLang ) : void {
		$this->setAttribute( 'lang', $i_strLang );
	}


	public function setSpellCheck( bool $i_bSpellCheck ) : void {
		$this->setAttribute( 'spellcheck', $i_bSpellCheck ? "true" : "false" );
	}


	public function setStyle( ... $i_rstStyle ) : void {
		$this->setAttribute( 'style', ... $i_rstStyle );
	}


	public function setTabIndex( int $i_iTabIndex ) : void {
		$this->setAttribute( 'tabindex', ( string ) $i_iTabIndex );
	}


	public function setTitle( string $i_strTitle ) : void {
		$this->setAttribute( 'title', $i_strTitle );
	}


	public function setTranslate( bool $i_bTranslate ) : void {
		$this->setAttribute( 'translate', $i_bTranslate ? "yes" : "no" );
	}


}


