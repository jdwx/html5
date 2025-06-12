<?php


declare( strict_types = 1 );


namespace JDWX\HTML5;


use Stringable;


readonly class AttributeModifier extends AbstractModifier {


    public function __construct( private string         $stAttribute, private string|Stringable $stValue,
                                 Stringable|string|null $nstContent = null ) {
        parent::__construct( $nstContent );
    }


    public function modify( ElementInterface $i_element ) : void {
        $i_element->setAttribute( $this->stAttribute, strval( $this->stValue ) );
    }


}
