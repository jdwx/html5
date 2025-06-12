<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/TraitInfo.php';


class ChildrenInfo extends TraitInfo {


    protected const string DATA_FILE = __DIR__ . '/children-data.json';


    /** @var array<string, mixed> */
    public static array $rData;


}
