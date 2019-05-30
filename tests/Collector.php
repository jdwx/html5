<?php


declare( strict_types = 1 );
namespace JDWX\HTML5\Tests;


class Collector {


	/** @var int */
	protected $uPassed = 0;

	/** @var string[] */
	protected $rTests = [];

	/** @var string[] */
	protected $rFails = [];


	public function __destruct() {
		$uTests = count( $this->rTests );
		echo "Passed ", $this->uPassed, " out of ", $uTests, " tests.\n";
		if ( $this->uPassed < $uTests )
			echo "Failed tests:\n  ", join( "\n  ", $this->rFails ), "\n";
	}


	public function check( string $i_stName, string $i_stExpect,
						   ?string $i_nstGot ) : void {

		if ( in_array( $i_stName, $this->rTests ) )
			echo "WARNING: Duplicate test name: ", $i_stName, "\n";

		$this->rTests[] = $i_stName;

		echo count( $this->rTests ), ". ", $i_stName, ": ";
		if ( $i_stExpect === $i_nstGot ) {
			echo "pass\n";
			$this->uPassed += 1;
			return;
		}

		echo "FAILED!\nExpect: ", $i_stExpect, "\n   Got: ",
			$i_nstGot ?? "(null)", "\n";
		$this->rFails[] = $i_stName;

	}


}


