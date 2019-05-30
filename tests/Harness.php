<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;
require_once 'vendor/autoload.php';
require_once __DIR__ . '/Mockument.php';


class Harness {


	/** @var Collector */
	protected $tst;

	/** @var Mockument */
	protected $moc;

	/** @var string */
	protected $stClass;

	/** @var string */
	protected $stMethod;

	/** @var int */
	protected $uCount;


	function __construct( Collector $i_tst ) {
		$this->moc = new Mockument;
		$this->tst = $i_tst;
		$r = explode( "\\", get_class( $this ) );
		$this->stClass = end( $r );
	}


	function check( string $i_stExpect, ?string $i_nstGot ) : void {
		$this->uCount += 1;
		$stName = "{$this->stMethod}({$this->uCount})";
		$this->tst->check( $stName, $i_stExpect, $i_nstGot );
	}


	function checkBool( bool $i_bExpect, bool $i_bGot ) : void {
		$stExpect = $i_bExpect ? 'true' : 'false';
		$stGot    = $i_bGot    ? 'true' : 'false';
		$this->check( $stExpect, $stGot );
	}


	function checkDocument( \JDWX\HTML5\IDocument $i_doc ) : void {
		$this->checkBool( true, $this->moc === $i_doc );
	}


	function checkElement( string $i_stExpect,
						   \JDWX\HTML5\Element $i_elGot ) : void {
		$stGot = strval( $i_elGot );
		$this->check( $i_stExpect, $stGot );

	}


	function checkFalse( bool $i_bGot ) : void {
		$this->checkBool( false, $i_bGot );
	}


	function checkNull( $i_xGot ) : void {
		$this->checkBool( true, null === $i_xGot );
	}


	function checkTrue( bool $i_bGot ) : void {
		$this->checkBool( true, $i_bGot );
	}


	function run() : void {
		foreach ( get_class_methods( get_class( $this ) ) as $stMethod ) {
			if ( 'test' !== substr( $stMethod, 0, 4 ) )
				continue;
			$this->uCount = 0;
			$this->stMethod = strlen( $stMethod ) > 4
				? $this->stClass . "_" . substr( $stMethod, 4 )
				: $this->stClass;
			$this->$stMethod();
		}
	}


}



