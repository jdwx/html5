<?php


declare( strict_types = 1 );


namespace JDWX\HTML5\Gen;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Generator.php';
require_once __DIR__ . '/TagInfo.php';


( function ( array $argv ) : void {

    array_shift( $argv ); # Don't need the command.

    if ( empty( $argv ) ) {
        $argv = TagInfo::listKeys();
    }

    foreach ( $argv as $stArg ) {
        MakeElement( $stArg );
    }


} )( $argv );


function MakeElement( string $i_stTagName ) : void {

    $stTagName = strtolower( trim( $i_stTagName ) );
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
    foreach ( $tag->childTraits() as $stTrait ) {
        $rUse[] = "use JDWX\\HTML5\\Children\\{$stTrait};";
    }
    foreach ( $tag->attrTraits() as $stTrait ) {
        $rUse[] = "use JDWX\\HTML5\\Attributes\\{$stTrait};";
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
    $rTraits = [];
    foreach ( $tag->traits() as $stTrait ) {
        $rTraits[ $stTrait ] = "    use {$stTrait};";
        $bAnyTraits = true;
    }
    foreach ( $tag->childTraits() as $stTrait ) {
        $rTraits[ $stTrait ] = "    use {$stTrait};";
        $bAnyTraits = true;
    }
    foreach ( $tag->attrTraits() as $stTrait ) {
        $rTraits[ $stTrait ] = "    use {$stTrait};";
        $bAnyTraits = true;
    }
    if ( $bAnyTraits ) {
        ksort( $rTraits );
        $st .= implode( "\n", $rTraits );
        $st .= "\n\n\n";
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

}