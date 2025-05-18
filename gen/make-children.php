<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Generator.php';
require_once __DIR__ . '/ChildrenInfo.php';


( function ( $argv ) : void {


    array_shift( $argv ); # Don't want command.

    $stTrait = array_shift( $argv );
    $trait = new ChildrenInfo( $stTrait, false );

    $rUse = [
        'use JDWX\HTML5\Element;',
        'use Stringable;',
    ];
    foreach ( $trait->all() as $stChildTag ) {
        $tag = new TagInfo( $stChildTag, true );
        $rUse[] = "use JDWX\\HTML5\\Elements\\{$tag->className()};";
    }
    sort( $rUse );
    $stUse = "\n\n" . implode( "\n", $rUse ) . "\n";

    $st = <<<ZEND
    <?php
    
    
    declare( strict_types = 1 );
    
    
    namespace JDWX\HTML5\Children;
    {$stUse}
    
    trait {$trait->trait()} {  



    ZEND;


    $rMethods = [];
    foreach ( $trait->all() as $stChildTag ) {
        $rMethods[ $stChildTag ] = Generator::generateChild( $stChildTag, true );
    }

    ksort( $rMethods );

    foreach ( $rMethods as $stMethod ) {
        $st .= '    ' . trim( $stMethod ) . "\n\n\n";
    }


    $st .= "}\n";

    $stFilename = __DIR__ . "/../src/Children/{$trait->trait()}.php";
    Generator::updateFile( $stFilename, $st, $trait->name() );


} )( $argv );