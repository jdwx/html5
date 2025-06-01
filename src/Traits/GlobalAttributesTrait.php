<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Traits;


use JDWX\HTML5\Attributes\AccessKeyTrait;
use JDWX\HTML5\Attributes\AutoCapitalizeTrait;
use JDWX\HTML5\Attributes\AutoCorrectTrait;
use JDWX\HTML5\Attributes\ContentEditableTrait;
use JDWX\HTML5\Attributes\DirTrait;
use JDWX\HTML5\Attributes\DraggableTrait;
use JDWX\HTML5\Attributes\HiddenTrait;
use JDWX\HTML5\Attributes\LangTrait;
use JDWX\HTML5\Attributes\OnClickTrait;
use JDWX\HTML5\Attributes\SpellCheckTrait;
use JDWX\HTML5\Attributes\StyleTrait;
use JDWX\HTML5\Attributes\TabIndexTrait;
use JDWX\HTML5\Attributes\TitleTrait;
use JDWX\HTML5\Attributes\TranslateTrait;


trait GlobalAttributesTrait {


    use AccessKeyTrait;
    use AutoCapitalizeTrait;
    use AutoCorrectTrait;
    use ContentEditableTrait;
    use DirTrait;
    use DraggableTrait;
    use HiddenTrait;
    use LangTrait;
    use OnClickTrait;
    use SpellCheckTrait;
    use StyleTrait;
    use TabIndexTrait;
    use TitleTrait;
    use TranslateTrait;
}