<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


class Document implements IDocument {

	/** @var string */
	protected $stDocType = "html";

	/** @var Elements\HTML */
	protected $elHTML;

	/** @var Elements\Head */
	protected $elHead;

	/** @var Elements\Body */
	protected $elBody;


	function __construct( string $i_stCharset = 'utf-8' ) {
		$this->elHead = new Elements\Head( $this );
		$this->elBody = new Elements\Body( $this );
		$this->elHTML = new Elements\HTML( $this, $this->elHead,
											  $this->elBody );

		$elMeta = new Elements\Meta( $this->elHead );
		$elMeta->setCharset( $i_stCharset );

	}


	function __toString() : string {
		$st = "<!DOCTYPE " . $this->stDocType . ">";
		return $st . $this->elHTML;
	}


	function addCSSFile( string $i_stHref ) {
		new Elements\Link(
			$this->elHead, $i_stHref, 'stylesheet', 'text/css'
		);
	}


	function addIconFile( string $i_stHref,
					      string $i_stType = "image/vnd.microsoft.icon" ) {
		new Elements\Link( $this->elHead, $i_stHref, 'icon', $i_stType );
	}


	function appendChild( ... $i_rxChildren ) : void {
		$this->appendToBody( ... $i_rxChildren );
	}


	function appendToBody( ... $i_rxChildren ) {
		$this->elBody->appendChild( ...$i_rxChildren );
	}


	function appendToTitle( string $i_stTitle ) {
		$elTitle = $this->elHead->findFirstChildByTagName( 'title' );
		if ( $elTitle instanceOf IElement )
			$elTitle->appendChild( $i_stTitle );
		else
			$this->setTitle( $i_stTitle );
	}


	function body() : Elements\Body {
		return $this->elBody;
	}


	function escapeValue( string $i_stValue ) : string {
		return htmlspecialchars( $i_stValue, ENT_COMPAT | ENT_HTML5,
                                 'UTF-8' );
	}


	function getDocument() : IDocument {
		return $this;
	}


	function head() : Elements\Head {
		return $this->elHead;
	}


	function setTitle( string $i_stTitle ) {
		$this->elHead->dropChildrenByTagName( 'title' );
		new Elements\Title( $this->elHead, $i_stTitle );
	}


	function tidy() : string {
		$htm = strval( $this );
		$cfgTidy = [
			'drop-empty-paras'  => false,
			'indent'            => true,
			'merge-divs'        => false,
			'merge-spans'       => false,
			'output-html'       => true,
			'output-xml'        => false,
			'preserve-entities' => true,
			'input-xml'         => false,
			'wrap'              => 100,
		];
		$tidy = new \tidy();
		$tidy->parseString( $htm, $cfgTidy, 'utf8' );
		return tidy_get_output( $tidy );
	}


}


