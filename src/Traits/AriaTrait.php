<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\HTML5\Attributes\AriaHiddenTrait;
use JDWX\HTML5\Attributes\AriaLabelTrait;
use JDWX\HTML5\Attributes\RoleTrait;


trait AriaTrait {


    use AriaHiddenTrait;
    use AriaLabelTrait;
    use RoleTrait;
}
