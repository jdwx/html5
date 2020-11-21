<?php


namespace JDWX\HTML5\Tests;


require __DIR__ . '/ElementHack.php';
require __DIR__ . '/Mockument.php';


use JDWX\HTML5\IElement;
use JDWX\HTML5\IDocument;


class TestCase extends \PHPUnit\Framework\TestCase {


    protected Mockument $doc;


    public function __construct( ) {
        parent::__construct();
        $this->doc = new Mockument;
    }


    protected function checkBool( bool $i_bExpect, bool $i_bGot ) : void {
        self::assertEquals( $i_bExpect, $i_bGot );
    }


    protected function checkDocument( IDocument $i_doc ) : void {
        $this->checkBool( true, $this->doc === $i_doc );
    }


    protected function checkElement( string $i_stExpect, IElement $i_elGot ) : void {
        $stGot = (string) $i_elGot;
        self::assertEquals( $i_stExpect, $stGot );
    }


    protected function checkFalse( bool $i_bGot ) : void {
        $this->checkBool( false, $i_bGot );
    }


    protected function checkNull( $i_xGot ) : void {
        $this->checkBool( true, null === $i_xGot );
    }


    protected function checkTrue( bool $i_bGot ) : void {
        $this->checkBool( true, $i_bGot );
    }


    protected function element( string $i_stTag ) : ElementHack {
        return new ElementHack( $this->doc, $i_stTag );
    }



}