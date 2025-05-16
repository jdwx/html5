<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


class Fragment implements DocumentInterface {


    /** @var Element[] */
    protected array $rElements = [];

    protected DummyDocument $doc;


    public function __construct( string $i_stCharset = 'utf-8' ) {
        $this->doc = new DummyDocument( $i_stCharset );
    }


    public function __toString() : string {
        return implode( '', $this->rElements );
    }


    /**
     * @param list<string|Element>|string|Element ...$i_rxChildren
     * @noinspection PhpDocSignatureInspection
     */
    public function append( array|Element|string ...$i_rxChildren ) : void {
        foreach ( $i_rxChildren as $xChild ) {
            if ( is_array( $xChild ) ) {
                $this->append( ... $xChild );
            } else {
                $this->rElements[] = $xChild;
            }
        }
    }


    public function escapeValue( string $i_stValue ) : string {
        return $this->doc->escapeValue( $i_stValue );
    }


    public function getDocument() : DocumentInterface {
        return $this->doc;
    }


}


