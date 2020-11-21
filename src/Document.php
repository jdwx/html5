<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use tidy;

class Document extends BaseDocument {


	protected string $stDocType = "html";

	protected Elements\HTML $elHTML;

	protected Elements\Head $elHead;

	protected Elements\Body $elBody;


	public function __construct( string $i_stCharset = 'UTF-8' ) {
		parent::__construct( $i_stCharset );
		$this->elHead = new Elements\Head( $this );
		$this->elBody = new Elements\Body( $this );
		$this->elHTML = new Elements\HTML( $this, $this->elHead,
										   $this->elBody );

		$elMeta = new Elements\Meta( $this->elHead );
		$elMeta->setCharset( $i_stCharset );

	}


	public function __toString() : string {
		$st = "<!DOCTYPE " . $this->stDocType . ">";
		return $st . $this->elHTML;
	}


	public function addCSSFile( string $i_stHref ) : void {
		new Elements\Link(
			$this->elHead, $i_stHref, 'stylesheet', 'text/css'
		);
	}


	public function addIconFile( string $i_stHref,
					             string $i_stType = "image/vnd.microsoft.icon" ) : void {
		new Elements\Link( $this->elHead, $i_stHref, 'icon', $i_stType );
	}


	public function appendChild( ... $i_rxChildren ) : void {
		$this->appendToBody( ... $i_rxChildren );
	}


	public function appendToBody( ... $i_rxChildren ) : void {
		$this->elBody->appendChild( ...$i_rxChildren );
	}


	public function appendToTitle( string $i_stTitle ) : void {
		$elTitle = $this->elHead->findFirstChildByTagName( 'title' );
		if ( $elTitle instanceOf IElement ) {
            $elTitle->appendChild($i_stTitle);
        } else {
            $this->setTitle($i_stTitle);
        }
	}


	public function body() : Elements\Body {
		return $this->elBody;
	}


	public function head() : Elements\Head {
		return $this->elHead;
	}


	public function setTitle( string $i_stTitle ) : void {
		$this->elHead->dropChildrenByTagName( 'title' );
		new Elements\Title( $this->elHead, $i_stTitle );
	}


	public function tidy() : string {
		$htm = ( string ) $this;
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
		$tidy = new tidy();
		$tidy->parseString( $htm, $cfgTidy, 'utf8' );
		return tidy_get_output( $tidy );
	}


}


