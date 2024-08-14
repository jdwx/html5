<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


/**
 * This class exists to serve as a placeholder parent for elements that aren't
 * actually part of a document.
 */
class DummyDocument extends AbstractDocument {


    public function appendChild( array|Element|string ...$i_rxChildren ) : void {
        // Do nothing.
    }


}


