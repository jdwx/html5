<?php declare( strict_types = 1 );


require_once __DIR__ . '/MyTestCase.php';


use JDWX\HTML5\Document;
use JDWX\HTML5\ElementFactory;
use JDWX\HTML5\Elements;
use PHPUnit\Framework\Attributes\CoversClass;


#[CoversClass( Document::class )]
class DocumentTest extends MyTestCase {


    /** @noinspection HtmlUnknownTarget */
    public function testAddToTitleWithNoTitle() : void {
        $doc = new Document();
        $doc->appendToTitle( 'Example Title' );
        $stExpect =
            '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Example Title</title></head><body></body></html>';
        self::assertEquals( $stExpect, ( string ) $doc );
    }


    public function testDocument() : void {

        $doc = new Document();
        $doc->setTitle( 'Example' );
        $doc->appendToTitle( ' Title' );
        $doc->addCSSFile( 'test.css' );
        $doc->body()->setClass( 'foo' );

        $a = ElementFactory::a( 'link' )->href( 'href' )->title( 'title' );
        $p = new Elements\Paragraph( 'text' );
        $doc->appendChild( 'This is a test.', $a, $p );
        $doc->addIconFile( 'favicon.ico' );

        $stHead =
            '<head><meta charset="UTF-8"><title>Example Title</title><link href="test.css" rel="stylesheet" type="text/css"><link href="favicon.ico" rel="icon" type="image/vnd.microsoft.icon"></head>';
        self::assertEquals( $stHead, ( string ) $doc->head() );

        $stExpect = '<!DOCTYPE html><html lang="en">' . $stHead .
            '<body class="foo">This is a test.<a href="href" title="title">link</a><p>text</p></body></html>';
        self::assertEquals( $stExpect, (string) $doc );

        $stTidy = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>
      Example Title
    </title>
    <link href="test.css" rel="stylesheet" type="text/css">
    <link href="favicon.ico" rel="icon" type="image/vnd.microsoft.icon">
  </head>
  <body class="foo">
    This is a test.<a href="href" title="title">link</a>
    <p>
      text
    </p>
  </body>
</html>';
        self::assertEquals( $stTidy, $doc->tidy() );

    }


}



