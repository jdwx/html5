<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\HTML5\Attributes\DisabledTrait;
use JDWX\HTML5\Attributes\FormTrait;
use JDWX\HTML5\Attributes\NameTrait;


trait FormChildTrait {


    use DisabledTrait;
    use FormTrait;
    use NameTrait;
}