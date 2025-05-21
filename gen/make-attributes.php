<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Generator.php';
require_once __DIR__ . '/AttributeInfo.php';


( function ( $argv ) : void {


    array_shift( $argv ); # Don't want command.

    if ( empty( $argv ) ) {
        $argv = AttributeInfo::listKeys();
    }

    foreach ( $argv as $stTrait ) {
        MakeAttribute( $stTrait );
    }
} )( $argv );


function MakeAttribute( string $i_stAttribute ) : void {
    $trait = new AttributeInfo( $i_stAttribute, false );

    $st = <<<ZEND
    <?php
    
    
    declare( strict_types = 1 );
    
    
    namespace JDWX\HTML5\Attributes;
    
    
    use JDWX\HTML5\Traits\AbstractAttributeTrait;
    
    
    trait {$trait->trait()} {
    
    
        use AbstractAttributeTrait;
    
    
    
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


}