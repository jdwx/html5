<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Generator.php';
require_once __DIR__ . '/TagInfo.php';


( function ( array $argv ) : void {

    array_shift( $argv ); # Don't need the command.

    $stTagName = strtolower( trim( array_shift( $argv ) ?? '' ) );
    if ( empty( $stTagName ) ) {
        error_log( 'No class name specified.' );
        exit( 1 );
    }

    $tag = new TagInfo( $stTagName, false );
    $rUse = [ "use JDWX\\HTML5\\{$tag->baseClass()};" ];
    if ( $tag->hasChildren() ) {
        $rUse[] = 'use Stringable;';
    }
    $stNamingInspection = strlen( $tag->className() ) < 3 ? ' /** @noinspection PhpClassNamingConventionInspection */' : '';
    foreach ( $tag->traits() as $stTrait ) {
        $rUse[] = "use JDWX\\HTML5\\Traits\\{$stTrait};";
    }
    sort( $rUse );
    $stUse = implode( "\n", $rUse ) . "\n";


    $st = <<<ZEND
<?php{$stNamingInspection}


declare( strict_types = 1 );


namespace JDWX\\HTML5\\Elements;


{$stUse}

class {$tag->className()} extends {$tag->baseClass()} {



ZEND;

    $bAnyTraits = false;
    foreach ( $tag->traits() as $stTrait ) {
        $st .= "    use {$stTrait};\n";
        $bAnyTraits = true;
    }
    if ( $bAnyTraits ) {
        $st .= "\n\n";
    }


    $st .= "    protected const string TAG_NAME = '{$stTagName}';\n\n\n";

    $rMethods = [];

    foreach ( $tag->children() as $stChildTag ) {
        $tagChild = new TagInfo( $stChildTag, true );
        $rMethods[ $tagChild->name() ] = Generator::generateChild( $stChildTag, false );
    }

    $rMethods += Generator::attributeMethodsList( $tag, false );

    ksort( $rMethods );

    foreach ( $rMethods as $stMethod ) {
        $st .= '    ' . trim( $stMethod ) . "\n\n\n";
    }


    $st .= "}\n";


    Generator::updateFile( __DIR__ . "/../src/Elements/{$tag->className()}.php", $st, $tag->className() );


} )( $argv );