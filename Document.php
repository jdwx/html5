<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


require_once __DIR__ . '/Element.php';
require_once __DIR__ . '/IDocument.php';


class Document implements IDocument {

	/** @var string */
	protected $strDocType = "html";

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
		$str = "<!DOCTYPE " . $this->strDocType . "><html><head>";
		$str .= "<meta charset=\"utf-8\">";
		if ( is_string( $this->nstTitle ) )
			$str .= "<title>" . $this->nstTitle . "</title>";
		foreach ( $this->rstCSSFiles as $strCSSFile )
			$str .= "<link href=\"" . $this->escapeValue( $strCSSFile )
				. "\" rel=\"stylesheet\" type=\"text/css\">";
		$str .= "</head>";
		$str .= $this->elBody;
		$str .= "</html>";
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
                                 'UTF-8' );
	}


	function setTitle( string $i_strTitle ) : Document {
		$this->nstTitle = $i_strTitle;
		return $this;
	}


	function tidy() : string {
		$htm = strval( $this );
		$cfgTidy = [
			'indent'     => true,
			'output-xml' => false,
			'input-xml'  => false,
			'wrap'       => 80,
		];
		$tidy = new \tidy();
		$tidy->parseString( $htm, $cfgTidy, 'utf8' );
		return tidy_get_output( $tidy );
	}


}


