<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


require_once __DIR__ . '/Element.php';
require_once __DIR__ . '/ElementFactory.php';
require_once __DIR__ . '/IDocument.php';


class Document implements IDocument {

	/** @var string */
	protected $strDocType = "html";

	/** @var Elements\HTML */
	protected $elHTML;

	/** @var Elements\Head */
	protected $elHead;

	/** @var Elements\Body */
	protected $elBody;


	function __construct() {
		$this->elHead = new Element( $this, 'head' );
		$this->elBody = new Element( $this, 'body' );
		$this->elHTML = ElementFactory::html( $this, $this->elHead,
											  $this->elBody );
	}


	function __toString() : string {
		$str = "<!DOCTYPE " . $this->strDocType . ">";
		/*
		<html><head>";
		$str .= "<meta charset=\"utf-8\">";
		if ( is_string( $this->nstTitle ) )
			$str .= "<title>" . $this->nstTitle . "</title>";
		foreach ( $this->rstCSSFiles as $strCSSFile )
			$str .= "<link href=\"" . $this->escapeValue( $strCSSFile )
				. "\" rel=\"stylesheet\" type=\"text/css\">";
		$str .= "</head>";
		$str .= $this->elBody;
		$str .= "</html>"; */
		return $str . $this->elHTML;
	}


	function addCSSFile( string $i_strHref ) : Document {
		ElementFactory::link(
			$this->elHead, $i_strHref, 'stylesheet', 'text/css'
		);
		return $this;
	}


	function addIconFile( string $i_strHref,
					      string $i_strType = "image/vnd.microsoft.icon" )
																  : Document {
		ElementFactory::link( $this->elHead, $i_strHref, 'icon', $i_strType );
		return $this;
	}


	function appendChild( ... $i_rxChildren ) : void {
		$this->appendToBody( ... $i_rxChildren );
	}


	function appendToBody( ... $i_rxChildren ) : Document {
		$this->elBody->appendChild( ...$i_rxChildren );
		return $this;
	}


	function appendToTitle( string $i_strTitle ) : Document {
		$elTitle = $this->elHead->findFirstChildByTagName( 'title' );
		if ( $elTitle instanceOf IElement )
			$elTitle->appendChild( $i_strTitle );
		else
			$this->setTitle( $i_strTitle );
		return $this;
	}


	function body() : Elements\Body {
		return $this->elBody;
	}


	function escapeValue( string $i_strValue ) : string {
		return htmlspecialchars( $i_strValue, ENT_COMPAT | ENT_HTML5,
                                 'UTF-8' );
	}


	function getDocument() : IDocument {
		return $this;
	}


	function head() : Elements\Head {
		return $this->elHead;
	}


	function setTitle( string $i_strTitle ) : Document {
		$this->elHead->dropChildrenByTagName( 'title' );
		ElementFactory::title( $this->elHead, $i_strTitle );
		return $this;
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


