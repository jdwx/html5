<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


require_once __DIR__ . '/Element.php';
require_once __DIR__ . '/IDocument.php';


class Document implements IDocument {

	/** @var string */
	protected $strDocType = "html";

	/** @var ?string */
	protected $nstEncoding = null;

	/** @var ?string */
	protected $nstTitle = null;

	/** @var Element */
	protected $elHTML;

	/** @var Element */
	protected $elHead;

	/** @var Element */
	protected $elBody;

	/** @var string[] */
	protected $rstCSSFiles = [];


	function __construct() {
		$this->elBody = new Element( $this, 'body' );
	}


	function __toString() : string {
		$str = "<!DOCTYPE " . $this->strDocType . ">\n<html>\n<head>\n";
		$str .= "<meta charset=\"" . $this->getEncoding() . "\">\n";
		if ( is_string( $this->nstTitle ) )
			$str .= "<title>" . $this->nstTitle . "</title>\n";
		foreach ( $this->rstCSSFiles as $strCSSFile )
			$str .= "<link href=\"" . $this->escapeValue( $strCSSFile )
				. "\" rel=\"stylesheet\" type=\"text/css\">\n";
		$str .= "</head>\n";
		$str .= $this->elBody;
		$str .= "\n</html>\n";
		return $str;
	}


	function addCSSFile( string $i_strCSSFile ) : Document {
		$this->rstCSSFiles[] = $i_strCSSFile;
		return $this;
	}


	function appendToBody( ... $i_rxChildren ) : Document {
		$this->elBody->appendChild( ...$i_rxChildren );
		return $this;
	}


	function body() : Element {
		return $this->elBody;
	}


	function createElement( string $i_strTagName ) : Element {
		$strTagName = trim( strtolower( $i_strTagName ) );
		$el = new Element( $this, $strTagName );
		switch ( $strTagName ) {
			case 'br':
				$el->setAlwaysClose( false );
				break;
		}
		return $el;
	}


	function escapeValue( string $i_strValue ) : string {
		return htmlspecialchars( $i_strValue, ENT_COMPAT | ENT_HTML5,
                                 $this->getEncoding() );
	}


	function getEncoding() : string {
		return $this->nstEncoding ?? ini_get( 'default_charset' );
	}


	function setTitle( string $i_strTitle ) : Document {
		$this->nstTitle = $i_strTitle;
		return $this;
	}


}


