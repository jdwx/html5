<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Generator.php';
require_once __DIR__ . '/AttributeInfo.php';


( function ( $argv ) : void {


    array_shift( $argv ); # Don't want command.

    $stTrait = array_shift( $argv );
    $trait = new AttributeInfo( $stTrait, false );

    $st = <<<ZEND
    <?php
    
    
    declare( strict_types = 1 );
    
    
    namespace JDWX\HTML5\Attributes;
    
    
    use JDWX\HTML5\Traits\AbstractElementTrait;
    
    
    trait {$trait->trait()} {
    
    
        use AbstractElementTrait;
    
    
    
    ZEND;

    $rMethods = [];
    $rMethods += Generator::attributeMethods( $trait->name(), $trait->tag(), $trait->all(), true );
    ksort( $rMethods );

    foreach ( $rMethods as $stMethod ) {
        $st .= '    ' . trim( $stMethod ) . "\n\n\n";
    }


    $st .= "}\n";

    $stFilename = __DIR__ . "/../src/Attributes/{$trait->trait()}.php";
    Generator::updateFile( $stFilename, $st, $trait->name() );


} )( $argv );